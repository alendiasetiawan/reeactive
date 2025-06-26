<?php

namespace App\Livewire\Member\Registrations;

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
use App\Models\Referral;
use App\Models\PhoneCode;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\FromInfluencerRegistration;
use Illuminate\Support\Str;
use App\Models\Registration;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\InfluencerReferral;
use App\Models\VoucherMerchandise;
use Illuminate\Support\Facades\DB;
use App\Models\ReferralRegistration;
use Illuminate\Support\Facades\Hash;
use App\Services\ReferralCodeService;
use App\Services\RegistrationService;

class FormNewMember extends Component
{
    use WithFileUploads;

    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Member Baru')]

    //Object
    public $healthScreenings, $phoneCodes, $countries, $provinces, $batch, $specialProgram, $selectedProgram, $selectedCoach, $selectedClass;
    //String
    public $poinSatu, $poinDua, $poinTiga, $poinEmpat, $poinLima, $poinEnam, $questionOne, $questionTwo, $questionThree, $questionFour, $questionFive, $questionSix, $questionSeven, $questionEight, $questionNine, $fileUpload, $uploadedFileName, $memberName, $address, $countryPhoneCode, $phone, $medicalFile, $medicalFileName, $medical_condition, $discount, $password, $registrationType, $openDate, $voucherValidDate, $referralCode, $memberCode;
    //Integer
    public $price, $amountDisc, $priceAfterDisc, $adminFee, $totalPrice, $discountReferral, $referralId, $countReferralUsed, $referralLimit, $discountReferralAmount, $provinceId, $countryId, $regencyId, $districtId, $ageStart, $bodyHeight, $bodyWeight, $quotaLeft, $selectedLevel = 1, $registered, $totalSteps = 4, $currentStep = 1, $countReferralInfluencerUsed, $influencerReferralLimit, $influencerReferralId, $influencerId;
    //Boolean
    public $questionSpecialCase = false, $nextStep = false, $specialCase = false, $showProgressBar = false, $alertUserExist = false, $alertQuota = false, $alertAddress = false, $isReferralFound, $isRegisteredEarly, $isCashBack, $isRegistered, $isReferralCodeError = false, $regulerReferralFound, $influencerReferralFound, $isReferralInfluencerExpired, $referralCodeFound;

    protected $batchService;
    protected $registrationService;
    protected ReferralCodeService $referralCodeService;

    public function boot(RegistrationService $registrationService, ReferralCodeService $referralCodeService) {
        $this->registrationService = $registrationService;
        $this->referralCodeService = $referralCodeService;

        //check the medical condition
        if ($this->questionEight == 'Cardiovascular') {
            $this->medical_condition = $this->questionEight;
        } elseif ($this->questionEight == NULL) {
            $this->medical_condition = NULL;
        } else {
            $this->medical_condition = $this->questionNine;
        }

        $this->specialProgram = Program::find(3);
    }

    public function mount(BatchService $batchService) {
        $this->batch = $batchService->batchQuery();
        $this->openDate = $this->batch->start_date;
        $this->currentStep = 1;
        $this->phoneCodes = PhoneCode::all();
        $this->countries = Country::orderBy('country_name', 'asc')->pluck('country_name', 'id');
        $this->provinces = Province::all();
        $this->discount = $this->batch->disc_early_bird;
        $this->referralLimit = $this->batch->referral_limit;
        $this->voucherValidDate = Carbon::parse($this->openDate)->addDays(90)->format('Y-m-d');
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

            $this->price = $pricelist->price_per_person;
            $this->adminFee = $this->batch->admin_fee;

            if (!$this->isReferralCodeError) {
                $this->priceAfterDisc = $this->price - $this->discountReferral;
            } else {
                $this->priceAfterDisc = $this->price;
            }

            $this->totalPrice = $this->priceAfterDisc + $this->adminFee;
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

        if ($property == 'referralCode') {
            //Check if code exists
            $this->regulerReferralFound = Referral::where('code', $this->referralCode)->exists();
            $this->influencerReferralFound = InfluencerReferral::where('code', $this->referralCode)->exists();

            if ($this->regulerReferralFound || $this->influencerReferralFound) {
                $this->referralCodeFound = true;
            } else {
                $this->referralCodeFound = false;
            }

            //Check if code's owner is registered by early bird
            if ($this->regulerReferralFound) {
                $queryReferral = Referral::where('code', $this->referralCode)->first();
                $this->memberCode = $queryReferral->member_code;
                $this->referralId = $queryReferral->id;

                $this->isRegisteredEarly = Registration::where('member_code', $this->memberCode)
                ->where('batch_id', $this->batch->id)
                ->where('registration_type', 'Early Bird')
                ->exists();

                $this->isRegistered = Registration::where('member_code', $this->memberCode)
                ->where('batch_id', $this->batch->id)
                ->exists();

                $this->countReferralUsed = ReferralRegistration::where('member_code', $this->memberCode)
                ->where('batch_id', $this->batch->id)
                ->count();

                if (!$this->regulerReferralFound || ($this->countReferralUsed >= $this->referralLimit) || $this->isRegisteredEarly) {
                    $this->isReferralCodeError = true;
                } else {
                    $this->isReferralCodeError = false;
                }
            }

            //Check if referral code is influencer
            if ($this->influencerReferralFound) {
                $queryReferralInfluencer = InfluencerReferral::where('code', $this->referralCode)->first();
                $this->discountReferral = $queryReferralInfluencer->discount;
                $this->influencerReferralLimit = $queryReferralInfluencer->used_limit;
                $this->influencerReferralId = $queryReferralInfluencer->id;
                $this->influencerId = $queryReferralInfluencer->influencer_id;

                //Check if referral code is valid
                if ($queryReferralInfluencer->is_active == 0 || date('Y-m-d') > $queryReferralInfluencer->expired_date) {
                    $this->isReferralInfluencerExpired = true;
                }
                else {
                    $this->isReferralInfluencerExpired = false;
                }

                //Check how many times referral code has been used
                $this->countReferralInfluencerUsed = FromInfluencerRegistration::where('influencer_referral_id', $this->influencerReferralId)
                ->where('batch_id', $this->batch->id)
                ->count();

                if (!$this->influencerReferralFound || ($this->countReferralInfluencerUsed >= $this->influencerReferralLimit) || $this->isReferralInfluencerExpired) {
                    $this->isReferralCodeError = true;
                } else {
                    $this->isReferralCodeError = false;
                }
            } else {
                $this->discountReferral = $this->batch->discount_referral;
            }

            if ($this->referralCode == null) {
                $this->isReferralCodeError = false;
            }
        }

    }

    public function selectFile() {
        $this->showProgressBar = true;
    }

    public function clearReferralCode() {
        $this->reset('referralCode');
        $this->isReferralCodeError = false;
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
        $batchId = $this->batch->id;
        $isDigitZero = strpos($this->phone, 0);
        if ($isDigitZero === 0) {
            $realPhone = Str::of($this->phone)->substr(1);
        } else {
            $realPhone = $this->phone;
        }

        $mobilePhone = $this->countryPhoneCode.$realPhone;


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
                //Add data member
                Member::updateOrCreate([
                    'code' => $realPhone,
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

                //Insert data registration
                $registration = Registration::updateOrCreate([
                    'member_code' => $realPhone,
                ], [
                    'batch_id' => $batchId,
                    'amount_pay' => $this->totalPrice,
                    'admin_fee' => $this->adminFee,
                    'program_price' => $this->price,
                    'file_upload' => $this->fileUpload->storeAs($batchId, $this->uploadedFileName, 'public'),
                    'payment_status' => 'Process',
                    'registration_category' => 'New Member',
                    'registration_type' => 'Reguler',
                    'program_id' => $this->selectedProgram,
                    'level_id' => 1,
                    'coach_id' => $this->coach->id,
                    'class_id' => $this->selectedClass,
                ]);

                //Create data user login
                User::updateOrCreate([
                    'email' => $realPhone,
                ], [
                    'password' => Hash::make($this->password),
                    'role_id' => 3,
                    'full_name' => $this->memberName,
                    'gender' => 'Perempuan',
                    'default_pw' => 0,
                ]);

                //Insert data user who registered using referral code
                if ($this->regulerReferralFound && !$this->isRegisteredEarly && ($this->countReferralUsed < $this->referralLimit)) {
                    if ($this->isRegistered) {
                        $isCashBack = 1;
                        $isUsed = 0;
                    } else {
                        $isCashBack = 0;
                        $isUsed = 1;
                    }

                    ReferralRegistration::create([
                        'batch_id' => $this->batch->id,
                        'referral_id' => $this->referralId,
                        'member_code' => $this->memberCode,
                        'registration_id' => $registration->id,
                        'date' => date('Y-m-d'),
                        'is_cashback' => $isCashBack,
                        'is_used' => $isUsed,
                        'discount' => $this->discountReferral
                    ]);
                }

                //Insert data user who registered using influncer referral
                if ($this->influencerReferralFound && ($this->countReferralInfluencerUsed < $this->influencerReferralLimit) && !$this->isReferralInfluencerExpired){
                    FromInfluencerRegistration::create([
                        'registration_id' => $registration->id,
                        'influencer_referral_id' => $this->influencerReferralId,
                        'influencer_id' => $this->influencerId,
                        'batch_id' => $this->batch->id
                    ]);
                }

                //Create Voucher Merchandise
                VoucherMerchandise::generateVoucherMerchandise($this->batch->id, $this->phone, $this->voucherValidDate, $registration->id);

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
