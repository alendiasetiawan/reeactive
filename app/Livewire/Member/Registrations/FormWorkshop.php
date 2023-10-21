<?php

namespace App\Livewire\Member\Registrations;

use Exception;
use App\Models\User;
use App\Models\Coach;
use App\Models\Member;
use App\Models\Program;
use App\Models\Regency;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\District;
use App\Models\Province;
use App\Models\PhoneCode;
use App\Models\Pricelist;
use App\Models\ClassModel;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\WorkshopRegistration;
use Illuminate\Support\Facades\Hash;
use App\Services\RegistrationService;

class FormWorkshop extends Component
{
    use WithFileUploads;

    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Workshop')]

    public int $currentStep = 1;
    public int $totalStep = 3;
    public $poinSatu;
    public $poinDua;
    public $poinTiga;
    public $poinEmpat;
    public bool $nextStep = false;
    public bool $alertUserExist = false;
    public bool $alertAddress = false;
    public object $programs;
    public int $selectedProgram;
    public int $selectedClass;
    public string $price;
    public string $normalPrice;
    public int $priceNumber;
    public int $normalPriceNumber;
    public string $voucherMember;
    public bool $alertDiscount = false;
    public string $coachCode;
    public int $coachId = 9;
    public int $quotaLeft = 1;
    public object $provinces;
    public bool $showProgressBar = false;
    public $fileUpload;
    public $uploadedFileName;
    public string $memberName;
    public int $ageStart;
    public int $bodyHeight;
    public int $bodyWeight;
    public string $address;
    public int $countryPhoneCode;
    public int $phone;
    public object $phoneCodes;
    public string $password;
    public bool $isVoucher;
    public int $provinceId;
    public int $regencyId;
    public int $districtId;
    public string $medicalCondition;

    protected $batchQuery;
    protected $registrationService;

    #[Computed]
    public function classCoach() {
        return ClassModel::where('coach_code', $this->coachCode)
        ->where('program_id', $this->selectedProgram)
        ->first();
    }

    #[Computed]
    public function districts() {
        return District::where('regency_id', $this->regencyId)->get();
    }

    #[Computed]
    public function regencies() {
        return Regency::where('province_id', $this->provinceId)->get();
    }

    public function mount() {
        $this->programs = Program::where('program_type', 'Workshop')->where('program_status', 'Open')->get();
        $this->phoneCodes = PhoneCode::all();
        $this->provinces = Province::all();
    }

    public function boot(RegistrationService $registrationService, BatchService $batchService) {
        $this->registrationService = $registrationService;
        $this->batchQuery = $batchService->workshopBatchQuery();
    }

    public function increaseStep() {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep += 1;
    }

    public function decreaseStep() {
        $this->resetErrorBag();
        $this->currentStep -= 1;

        if($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData() {
        if ($this->currentStep == 1) {
            $this->validate(
                [
                    'poinSatu' => 'accepted',
                    'poinDua' => 'accepted',
                    'poinTiga' => 'accepted',
                    'poinEmpat' => 'accepted',
                ],
                [
                    'poinSatu.accepted' => 'Anda belum membaca ketentuan ini?',
                    'poinDua.accepted' => 'Anda belum membaca ketentuan ini?',
                    'poinTiga.accepted' => 'Anda belum membaca ketentuan ini?',
                    'poinEmpat.accepted' => 'Anda belum membaca ketentuan ini?',
                ]
            );
        }
        if ($this->currentStep == 2) {
            $this->validate(
            [
                'selectedProgram' => 'required',
            ], [
                'selectedProgram.required' => 'Silahkan pilih program yang ingin anda ikuti!',
            ]
            );
        }
    }

    public function updatedSelectedProgram() {
        $this->reset('voucherMember');

        //Check price
        $priceList = Pricelist::where('program_id', $this->selectedProgram)->first();
        $this->priceNumber = $priceList->price;
        $this->price = 'Rp '.number_format($this->priceNumber,0,',','.');
        $this->coachCode = $priceList->coach_code;

        //Check quota
        $this->quotaLeft = $this->registrationService->quotaWorkshop($this->selectedProgram, $this->coachId);

        //Check class ID
        $classData = ClassModel::where('program_id', $this->selectedProgram)->first();
        $this->selectedClass = $classData->id;
    }

    public function updatedVoucherMember() {
        $this->alertDiscount = true;
        $this->isVoucher = Voucher::where('voucher_code', $this->voucherMember)->exists();
        $priceList = Pricelist::where('program_id', $this->selectedProgram)->first();

        if ($this->isVoucher) {
            $this->priceNumber = $priceList->price_special;
            $this->normalPriceNumber = $priceList->price;
            $this->normalPrice = 'Rp '.number_format($this->normalPriceNumber,0,',','.');
        } else {
            $this->priceNumber = $priceList->price;
        }

        $this->price = 'Rp '.number_format($this->priceNumber,0,',','.');
    }

    public function updatedAddress() {
        $textLenght = strlen($this->address);

        if($textLenght < 40) {
            $this->alertAddress = true;
        } else {
            $this->alertAddress = false;
        }
    }

    public function updatedProvinceId() {
        $this->reset('regencyId', 'districtId');
    }

    public function updatedRegencyId() {
        $this->reset('districtId');
    }

    public function selectFile() {
        $this->showProgressBar = true;
    }

    public function updatedFileUpload(){
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

    public function updatedPhone() {
        $checkUser = Member::where('code', $this->phone)->exists();

        if ($checkUser) {
            $this->alertUserExist = true;
        } else {
            $this->alertUserExist = false;
        }
    }

    public function register() {
        $this->validate([
            'provinceId' => 'required',
            'regencyId' => 'required',
            'districtId' => 'required',
            'medicalCondition' => 'required'
        ], [
            'provinceId.required' => 'Tolong isi provinsi nya ya!',
            'regencyId.required' => 'Tolong isi kabupaten nya ya!',
            'districtId.required' => 'Tolong isi kecamatan nya ya!',
            'medicalCondition.required' => 'Harap ditulis dengan lengkap riwayat persalinan anda!'
        ]);

        $this->quotaLeft = $this->registrationService->quotaWorkshop($this->selectedProgram, $this->coachId);

        if ($this->quotaLeft <= 0) {
            session()->flash('fullQuota', 'Daftar Gagal! Quota pendaftaran sudah penuh, silahkan pilih program yang lain');
            $this->redirect(route('workshop_register'));
        } else {
            // try {
                DB::beginTransaction();
                Member::updateOrCreate([
                    'code' => $this->phone,
                ], [
                    'member_name' => $this->memberName,
                    'gender' => 'Perempuan',
                    'address' => $this->address,
                    'country_id' => 1,
                    'province_id' => $this->provinceId,
                    'regency_id' => $this->regencyId,
                    'district_id' => $this->districtId,
                    'mobile_phone' => $this->countryPhoneCode.$this->phone,
                    'body_height' => $this->bodyHeight,
                    'body_weight' => $this->bodyWeight,
                    'age_start' => $this->ageStart,
                    'medical_condition' => $this->medicalCondition,
                ]);

                WorkshopRegistration::updateOrCreate([
                    'member_code' => $this->phone,
                ], [
                    'workshop_batch_id' => $this->batchQuery->id,
                    'amount_pay' => $this->priceNumber,
                    'file_upload' => $this->fileUpload->storeAs($this->batchQuery->id, $this->uploadedFileName, 'public'),
                    'payment_status' => 'Process',
                    'registration_category' => 'New Member',
                    'is_assessment' => 0,
                    'program_id' => $this->selectedProgram,
                    'coach_id' => 9,
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
                $this->redirect(route('workshop_registration_success', $this->memberName));

            // } catch (Exception) {
            //     DB::rollBack();
            //     session()->flash('failed', 'Daftar Gagal, Cek Koneksi dan Kolom Isian Anda');
            //     $this->redirect(route('workshop_register'));
            // }
        }
    }

    public function render()
    {
        return view('livewire.member.registrations.form-workshop');
    }
}
