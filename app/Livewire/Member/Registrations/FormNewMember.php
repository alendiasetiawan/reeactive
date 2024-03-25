<?php

namespace App\Livewire\Member\Registrations;

use App\Models\User;
use App\Models\Coach;
use App\Models\Member;
use App\Models\Country;
use App\Models\Program;
use App\Models\Regency;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\PhoneCode;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\Registration;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use App\Services\RegistrationService;
use Carbon\Carbon;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FormNewMember extends Component
{
    use WithFileUploads;

    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Member Baru')]

    public $batch;
    public $specialProgram;
    public $selectedProgram;
    public $selectedCoach;
    public $selectedClass;
    public $poinSatu;
    public $poinDua;
    public $poinTiga;
    public $poinEmpat;
    public $poinLima;
    public $poinEnam;
    public $questionOne;
    public $questionTwo;
    public $questionThree;
    public $questionFour;
    public $questionFive;
    public $questionSix;
    public $questionSeven;
    public $questionEight;
    public $questionNine;
    public ?int $price, $amountDisc, $priceAfterDisc, $adminFee, $totalPrice;
    public $healthScreenings;
    public $phoneCodes;
    public $countries;
    public $provinces;
    public $questionSpecialCase = false;
    public $nextStep = false;
    public $specialCase = false;
    public $provinceId;
    public $countryId;
    public $regencyId;
    public $districtId;
    public $fileUpload;
    public $showProgressBar = false;
    public $uploadedFileName;
    public $memberName;
    public $ageStart;
    public $bodyHeight;
    public $bodyWeight;
    public $address;
    public $countryPhoneCode;
    public $phone;
    public $medicalFile;
    public $password;
    public $quotaLeft;
    public $selectedLevel = 1;
    public $registered;
    public $medicalFileName;
    public $medical_condition;
    public $discount;
    public bool $isDiscountApply = false, $alertUserExist = false, $alertQuota = false, $alertAddress = false;
    public ?string $registrationType;

    public $totalSteps = 4;
    public $currentStep = 1;

    protected $batchService;
    protected $registrationService;

    public function boot(RegistrationService $registrationService) {
        $this->registrationService = $registrationService;

        //check the medical condition
        if ($this->questionEight == 'Cardiovascular') {
            $this->medical_condition = $this->questionEight;
        } elseif ($this->questionEight == NULL) {
            $this->medical_condition = NULL;
        } else {
            $this->medical_condition = $this->questionNine;
        }

        $this->specialProgram = Program::find(4);
    }

    public function mount(BatchService $batchService) {
        $this->batch = $batchService->batchQuery();
        $this->currentStep = 1;
        $this->phoneCodes = PhoneCode::all();
        $this->countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $this->provinces = Province::all();
        $this->discount = $this->batch->disc_early_bird;
    }

    #[Computed]
    public function programs() {
        return Program::where('program_status', 'Open')->where('program_type','Reguler')->get();
    }

    #[Computed]
    public function districts() {
        return District::where('regency_id', $this->regencyId)->get();
    }

    #[Computed]
    public function regencies() {
        return Regency::where('province_id', $this->provinceId)->get();
    }

    #[Computed]
    public function coaches() {
        return Pricelist::showActiveCoachEksternal($this->selectedProgram);
    }

    #[Computed]
    public function classes() {
        return ClassModel::showActiveClassExternal($this->selectedProgram, $this->selectedCoach);
    }

    #[Computed]
    public function coach() {
        return Coach::where('code', $this->selectedCoach)->first();
    }

    public function increaseStep() {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep += 1;
        $this->dispatch('move-page');
    }

    public function decreaseStep() {
        $this->resetErrorBag();
        $this->currentStep -= 1;

        if($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData() {
        if ($this->currentStep == 2) {
            $this->validate(
                [
                    'poinSatu' => 'accepted',
                    'poinDua' => 'accepted',
                    'poinTiga' => 'accepted',
                    'poinEmpat' => 'accepted',
                    'poinLima' => 'accepted',
                    'poinEnam' => 'accepted',
                ],
                [
                    'poinSatu.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinDua.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinTiga.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinEmpat.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinLima.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinEnam.accepted' => 'Anda belum setuju dengan akad ini',
                ]
            );
        }
        if ($this->currentStep == 3) {
            $this->validate(
            [
                'selectedProgram' => 'required',
                'selectedCoach' => 'required',
                'selectedClass' => 'required',
                'fileUpload' => 'required'
            ], [
                'selectedProgram.required' => 'Program apa yang anda ikuti?',
                'selectedCoach.required' => 'Silahkan pilih 1 coach',
                'selectedClass.required' => 'Pilih jadwal yang sesuai',
                'fileUpload.required' => 'Mohon untuk melampirkan bukti transfer, '
            ]
            );
        }
    }

    public function updated($property, $value) {
        if ($property == 'phone') {
            $checkUser = Member::where('code', $this->phone)->exists();

            if ($checkUser) {
                $this->alertUserExist = true;
            } else {
                $this->alertUserExist = false;
            }
        }

        if ($property == 'fileUpload') {
            $this->validate(
                [
                    'fileUpload' => 'mimes:png,jpg,jpeg|max:1024',
                ],
                [
                    'fileUpload.max' => 'Ukuran file tidak boleh lebih dari 1 MB.',
                    'fileUpload.mimes' => 'File harus dalam format gambar: .jpg/.jpeg/.png.',
                ]
            );
            $this->uploadedFileName = time().'.'.$this->fileUpload->extension();
        }

        if ($property == 'medicalFile') {
            $this->medicalFileName = time().'.'.$this->medicalFile->extension();
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

        if ($property == 'selectedCoach') {

            $this->reset('selectedClass');
        }

        if ($property == 'selectedClass') {

            $this->quotaLeft = $this->registrationService->quotaLeft($this->selectedProgram, $this->selectedLevel, $this->coach->id, $this->selectedClass, $this->batch->id);

            if ($this->quotaLeft <= 0) {
                $this->alertQuota = true;
            } else {
                $this->alertQuota = false;
            }

            $pricelist = Pricelist::where('program_id', $this->selectedProgram)
            ->where('coach_code', $this->selectedCoach)
            ->first();
            if ($this->specialCase == TRUE) {
                $this->price = $pricelist->price_special;
            } else {
                $this->price = $pricelist->price_per_person;
            }

            $this->adminFee = $this->batch->admin_fee;

            //Cek apakah tanggal daftar kurang dari tanggal buka batch
            $openDate = $this->batch->start_date;
            $dateToday = Carbon::now()->format('Y-m-d');

            if ($dateToday < $openDate) {
                $this->isDiscountApply = true;
                $this->amountDisc = $this->price * $this->discount;
                $this->priceAfterDisc = $this->price - $this->amountDisc;
                $this->totalPrice = $this->priceAfterDisc + $this->adminFee;
                $this->registrationType = 'Early Bird';
            } else {
                $this->isDiscountApply = false;
                $this->priceAfterDisc = $this->price;
                $this->totalPrice = $this->price + $this->adminFee;
                $this->registrationType = 'Reguler';
            }
        }

        if ($property == 'questionOne') {
            $this->reset('questionTwo', 'questionThree', 'questionFour', 'questionFive', 'questionSix', 'questionSeven', 'questionEight', 'questionNine');
            $this->nextStep = false;
            if ($value == 'Tidak') {
                $this->questionSpecialCase = true;
            } else {
                $this->questionSpecialCase = false;
            }
        }

        if ($property == 'questionTwo') {
            $this->reset('questionThree', 'questionFour', 'questionFive', 'questionSix', 'questionSeven', 'questionEight', 'questionNine');
            $this->questionSpecialCase = false;
        }

        if ($property == 'questionThree') {
            $this->reset('questionFour', 'questionFive', 'questionSix', 'questionSeven', 'questionEight', 'questionNine');
        }

        if ($property == 'questionFour') {
            if ($value == 'Tidak') {
                $this->questionSpecialCase = true;
            } else {
                $this->questionSpecialCase = false;
            }
            $this->reset('questionFive', 'questionSix', 'questionSeven', 'questionEight', 'questionNine');
        }

        if ($property == 'questionSix') {
            if ($value == 'Tidak') {
                $this->questionSpecialCase = true;
            } else {
                $this->questionSpecialCase = false;
            }
            $this->reset('questionSeven', 'questionEight', 'questionNine');
        }

        if ($property == 'questionSeven') {
            if ($value == 'Tidak') {
                $this->nextStep = true;
                $this->specialCase = false;
            } else {
                $this->specialCase = true;
                $this->nextStep = false;
            }
            $this->reset('questionEight', 'questionNine');
        }

        if ($property == 'questionEight') {
            if ($value == 'Cardiovascular') {
                $this->nextStep = true;
            } else {
                $this->nextStep = false;
            }
            $this->reset('questionNine');
        }

        if ($property == 'questionNine') {
            $this->nextStep = true;
        }

        if ($property == 'address') {
            $textLenght = strlen($this->address);

            if($textLenght < 40) {
                $this->alertAddress = true;
            } else {
                $this->alertAddress = false;
            }
        }

    }

    public function selectFile() {
        $this->showProgressBar = true;
    }

    public function register() {
        if ($this->countryId == 1) {
            $this->validate([
                'provinceId' => 'required',
                'regencyId' => 'required',
                'districtId' => 'required',
            ], [
                'provinceId.required' => 'Tolong isi provinsi dulu ya!',
                'regencyId.required' => 'Tolong isi kabupaten dulu ya!',
                'districtId.required' => 'Tolong isi kecamatan dulu ya!'
            ]);
        }
        $mobilePhone = $this->countryPhoneCode.$this->phone;
        $batchId = $this->batch->id;


        //check medical file
        if ($this->medicalFile == NULL) {
            $uploadMedicalFile = NULL;
        } else {
            $uploadMedicalFile = $this->medicalFile->storeAs($batchId, $this->medicalFileName, 'public');
        }

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

        //check program and class
        $program = Program::find($this->selectedProgram);
        $programName = $program->program_name;
        $coach = Coach::where('code', $this->selectedCoach)->first();
        $coachNickName = $coach->nick_name;
        $coachFullName = $coach->coach_name;
        $class = ClassModel::find($this->selectedClass);
        $classDay = $class->day;
        $classStartTime = $class->start_time;
        $classEndTime = $class->end_time;

        $this->quotaLeft = $this->registrationService->quotaLeft($this->selectedProgram, $this->selectedLevel, $this->coach->id, $this->selectedClass, $this->batch->id);

        if ($this->quotaLeft <= 0) {
            session()->flash('fullQuota', 'Daftar Gagal! Kelas yang anda pilih sudah penuh');
            $this->redirect(route('new_member'));
        } else {
            DB::beginTransaction();
            try {
                Member::updateOrCreate([
                    'code' => $this->phone,
                ], [
                    'member_name' => $this->memberName,
                    'gender' => 'Perempuan',
                    'address' => $this->address,
                    'country_id' => $this->countryId,
                    'province_id' => $provinsi,
                    'regency_id' => $kabupaten,
                    'district_id' => $kecamatan,
                    'mobile_phone' => $mobilePhone,
                    'body_height' => $this->bodyHeight,
                    'body_weight' => $this->bodyWeight,
                    'age_start' => $this->ageStart,
                    'medical_condition' => $this->medical_condition,
                    'medical_file' => $uploadMedicalFile,
                ]);

                Registration::updateOrCreate([
                    'member_code' => $this->phone,
                ], [
                    'batch_id' => $batchId,
                    'amount_pay' => $this->totalPrice,
                    'admin_fee' => $this->adminFee,
                    'program_price' => $this->priceAfterDisc,
                    'file_upload' => $this->fileUpload->storeAs($batchId, $this->uploadedFileName, 'public'),
                    'payment_status' => 'Process',
                    'registration_category' => 'New Member',
                    'registration_type' => $this->registrationType,
                    'program_id' => $this->selectedProgram,
                    'level_id' => 1,
                    'coach_id' => $this->coach->id,
                    'class_id' => $this->selectedClass,
                ]);

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
                $this->redirectRoute('registration_success', [
                    'memberName' => $this->memberName,
                    'programName' => $programName,
                    'coachFullName' => $coachFullName,
                    'coachNickName' => $coachNickName,
                    'classDay' => $classDay,
                    'classStartTime' => $classStartTime,
                    'classEndTime' => $classEndTime,
                    'email' => $this->phone,
                ]);

            } catch (Exception) {
                DB::rollBack();
                session()->flash('failed', 'Daftar Gagal, Cek Koneksi dan Kolom Isian Anda');
                $this->redirect(route('new_member'));
            }
        }
    }

    public function render()
    {
        return view('livewire.member.registrations.form-new-member');
    }
}
