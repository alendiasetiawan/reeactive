<?php

namespace App\Livewire\Registrations;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Coach;
use App\Models\Member;
use App\Models\Country;
use App\Models\Program;
use App\Models\Regency;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\ClassDate;
use App\Models\PhoneCode;
use App\Models\Pricelist;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use WireUi\View\Components\Card;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\SpecialRegistration;
use Illuminate\Support\Facades\Hash;

class FormAdditionalProgram extends Component
{
    use WithFileUploads;

    #[Title('Form Pendaftaran Program Lepas')]

    //Integer
    public $countryId, $provinceId, $regencyId, $districtId, $ageStart, $bodyHeight, $bodyWeight, $countryCode = 62, $phone, $selectedProgram = '', $selectedCoach = '', $selectedClass = '', $selectedSession = null, $addressLength = 0, $maxAddressLength = 200, $totalPrice, $pregnantWeek;
    //String
    public $memberName, $birthDate, $address, $nameDay, $fileUpload, $password, $fileUploadName, $folderName, $isPregnantSyndrom, $pregnantSyndromDetail, $uploadedFileName, $programName, $classStartTime, $classEndTime, $selectedDay;
    //Array
    public array $selectedDate = [];
    //Object
    public $programs, $phoneCodes, $programPrice, $countries, $provinces;
    //Boolean
    public $invalidDay, $isBodyHeightInvalid, $isBodyWeightInvalid, $showProgressBar, $isSubmitActive = false, $isPregnantFriendly, $isAllowedToJoin, $isUserRegistered;

    protected $rules = [
        'phone' => 'min_digits:8|max_digits:12|integer',
        'address' => 'min:40|max:200',
        'pregnantWeek' => 'required|integer|min:1|max:40',
        'pregnantSyndromDetail' => 'required|min:10|max:500',
        'fileUpload' => 'mimes:png,jpg,jpeg|max:1024',
    ];

    protected $messages = [
        'phone.min_digits' => 'Minimal 8 angka',
        'phone.max_digits' => 'Maksimal 12 angka',
        'phone.integer' => 'Tidak boleh diawali angka 0/titik(.)/koma(,)',
        'address.min' => 'Alamat tidak boleh terlalu pendek, minimal 40 karakter',
        'address.max' => 'Alamat maksimal 200 karakter',
        'pregnantWeek.required' => 'Usia kandungan harus diisi!',
        'pregnantWeek.min' => 'Minimal 1 minggu',
        'pregnantWeek.max' => 'Maksimal 40x minggu',
        'pregnantSyndromDetail.min' => 'Minimal 10 karakter',
        'pregnantSyndromDetail.max' => 'Maksimal 500 karakter',
        'pregnantSyndromDetail.required' => 'Tolong tulis detail keluhan kamu ya ^^',
        'fileUpload.max' => 'Ukuran file tidak boleh lebih dari 1 MB.',
        'fileUpload.mimes' => 'File harus dalam format gambar: .jpg/.jpeg/.png.',
    ];

    #[Computed]
    public function coaches() {
        return Pricelist::showActiveCoachEksternal($this->selectedProgram);
    }

    #[Computed]
    public function classes() {
        return ClassModel::showActiveClassExternal($this->selectedProgram, $this->selectedCoach);
    }

    #[Computed]
    public function districts() {
        return District::where('regency_id', $this->regencyId)->pluck('district_name', 'id');
    }

    #[Computed]
    public function regencies() {
        return Regency::where('province_id', $this->provinceId)->pluck('regency_name', 'id');
    }

    //HOOK - Execute once when component is rendered
    public function mount() {
        $this->programs = Program::where('program_type', 'Special')->where('program_status', 'Open')->get();
        $this->phoneCodes = PhoneCode::all();
        $this->countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $this->provinces = Province::pluck('province_name', 'id');
        $this->folderName = Carbon::now()->isoFormat('MMMM Y');
    }

    //HOOK - Check if property updated
    public function updated($property) {
        $this->isFormFilled();
        if ($property == 'birthDate') {
            $this->ageStart = Carbon::parse($this->birthDate)->age;
        }

        if ($property == 'phone') {
            //Check if user already registered
            $this->isUserRegistered = Member::where('code', $this->phone)->exists();
            $this->validateOnly('phone');
        }

        if ($property == 'address') {
            $this->addressLength = Str::length($this->address);
            $this->validateOnly('address');
        }

        if ($property == 'selectedClass') {
            $class = ClassModel::find($this->selectedClass);
            $this->selectedDay = $class->day;
            $this->classStartTime = $class->start_time;
            $this->classEndTime = $class->end_time;
        }

        if ($property == 'bodyHeight') {
            if ($this->bodyHeight > 250 || $this->bodyHeight < 100) {
                $this->isBodyHeightInvalid = true;
            } else {
                $this->isBodyHeightInvalid = false;
            }
        }

        if ($property == 'bodyWeight') {
            if ($this->bodyWeight > 200 || $this->bodyWeight < 30) {
                $this->isBodyWeightInvalid = true;
            } else {
                $this->isBodyWeightInvalid = false;
            }
        }

        if ($property == 'selectedProgram') {
            $program = Program::where('id', $this->selectedProgram)->first();
            $this->isPregnantFriendly = $program->is_pregnant_friendly;
            $this->programName = $program->program_name;

            $this->reset(['selectedCoach', 'selectedClass', 'selectedSession', 'selectedDate', 'pregnantWeek', 'isPregnantSyndrom', 'pregnantSyndromDetail']);
        }

        if (str_contains($property, 'selectedDate.')) {
            if (preg_match('/\.(\d+)/', $property, $matches)) {
                $index = $matches[1];
                $this->checkDay($index);
            }

            if ($this->checkDay($index) == true) {
                $this->invalidDay = false;
            } else {
                $this->invalidDay = true;
            }

        }

        if ($property == 'selectedSession') {

            //Setup program price
            $price = Pricelist::where('coach_code', $this->selectedCoach)
            ->where('program_id', $this->selectedProgram)
            ->select('coach_code', 'price', 'price_per_person')
            ->first();

            if ($this->selectedSession == 1) {
                $this->programPrice = $price->price_per_person;
            } else {
                $this->programPrice = $price->price;
            }

            $this->totalPrice = $this->programPrice;

            $this->reset(['selectedDate', 'pregnantWeek', 'isPregnantSyndrom', 'pregnantSyndromDetail', 'fileUpload']);
            $this->resetValidation('selectedDate', 'fileUpload');

            if ($this->isPregnantFriendly == 0) {
                $this->validateOnly('pregnantWeek');
            } else {
                $this->resetValidation('pregnantWeek');
            }
        }

        if ($property == 'countryId') {
            $this->reset('provinceId', 'regencyId', 'districtId');
        }

        if ($property == 'provinceId') {
            $this->reset('regencyId', 'districtId');
        }

        if ($property == 'regencyId') {
            $this->reset('districtId');
        }

        if ($property == 'fileUpload') {
            $this->uploadedFileName = time().'.'.$this->fileUpload->extension();
            $this->validateOnly('fileUpload');
        }

        if ($property == 'pregnantWeek') {
            if ($this->pregnantWeek < 12) {
                $this->isAllowedToJoin = false;
            } else {
                $this->isAllowedToJoin = true;
            }
            $this->validateOnly('pregnantWeek');
        }

        if ($property == 'isPregnantSyndrom') {
            if ($this->isPregnantSyndrom == 'Yes') {
                $this->validateOnly('pregnantSyndromDetail');
            } else {
                $this->resetValidation('pregnantSyndromDetail');
            }

            $this->reset('pregnantSyndromDetail');
        }

        if ($property == 'pregnantSyndromDetail') {
            $this->validateOnly('pregnantSyndromDetail');
        }
    }

    //ACTION - Check if selected date is match with days provided
    public function checkDay($index) {
        $numberDay = Carbon::parse($this->selectedDate[$index])->format('N');

        $checkDay = ClassModel::where('id', $this->selectedClass)
        ->where('day', 'LIKE', '%'.$numberDay.'%')
        ->exists();

        return $checkDay;
    }

    //ACTION - show prgress bar when user upload file
    public function selectFile() {
        $this->showProgressBar = true;
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->memberName) && !empty($this->birthDate) && !empty($this->bodyHeight) && !empty($this->bodyWeight) && !empty($this->phone) && !empty($this->address) && !empty($this->countryId) && !empty($this->selectedProgram) && !empty($this->selectedCoach) && !empty($this->selectedClass) && !empty($this->selectedSession) && !empty($this->fileUpload) && !empty($this->password)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    //ACTION - Save data
    public function register() {
        $queryCoach = Coach::where('code', $this->selectedCoach)->first();

        if($this->provinceId == NULL) {
            $provinsi = NULL;
        } else {
            $provinsi = $this->provinceId;
        }

        if($this->regencyId == NULL) {
            $kabupaten = NULL;
        } else {
            $kabupaten = $this->regencyId;
        }

        if($this->districtId == NULL) {
            $kecamatan = NULL;
        } else {
            $kecamatan = $this->districtId;
        }

        $mobilePhone = $this->countryCode.$this->phone;


        DB::beginTransaction();
        try {
            Member::updateOrCreate([
                'code' => $this->phone,
            ], [
                'member_name' => $this->memberName,
                'gender' => 'Perempuan',
                'birth_date' => $this->birthDate,
                'address' => $this->address,
                'country_id' => $this->countryId,
                'province_id' => $provinsi,
                'regency_id' => $kabupaten,
                'district_id' => $kecamatan,
                'mobile_phone' => $mobilePhone,
                'body_height' => $this->bodyHeight,
                'body_weight' => $this->bodyWeight,
                'age_start' => $this->ageStart,
            ]);

            //Store data to table special registration and grab it's id
            $registration = SpecialRegistration::create([
                'member_code' => $this->phone,
                'amount_pay' => $this->totalPrice,
                'program_price' => $this->programPrice,
                'file_upload' => $this->fileUpload->storeAs($this->folderName, $this->uploadedFileName, 'public'),
                'payment_status' => 'Process',
                'program_id' => $this->selectedProgram,
                'coach_id' => $queryCoach->id,
                'class_id' => $this->selectedClass
            ]);

            //Store data to table class_dates and using id from table special registration
            foreach ($this->selectedDate as $date) {
                ClassDate::create([
                    'special_registration_id' => $registration->id,
                    'date' => $date
                ]);
            }

            User::updateOrCreate([
                'email' => $this->phone,
            ], [
                'password' => Hash::make($this->password),
                'role_id' => 3,
                'full_name' => $this->memberName,
                'gender' => 'Perempuan',
                'default_pw' => 0,
            ]);

            DB::commit();
            $this->redirect(route('success_additional_registration', [
                'memberName' => $this->memberName,
                'coachFullName' => $queryCoach->coach_name,
                'coachNickName' => $queryCoach->nick_name,
                'programName' => $this->programName,
                'classDay' => $this->selectedDay,
                'classStartTime' => $this->classStartTime,
                'classEndTime' => $this->classEndTime
            ]));
        } catch (Exception) {
            DB::rollBack();
            session()->flash('registration_failed', 'Daftar Gagal, Cek Koneksi dan Kolom Isian Anda. Silahkan coba lagi!');
        }
    }

    public function render()
    {
        return view('livewire.registrations.form-additional-program')->layout('layouts.vuexy-blank');
    }
}
