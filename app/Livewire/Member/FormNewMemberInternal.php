<?php

namespace App\Livewire\Member;

use Exception;
use Carbon\Carbon;
use App\Models\Coach;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\Registration;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\ReferralRegistration;
use Illuminate\Support\Facades\Auth;
use App\Services\RegistrationService;

class FormNewMemberInternal extends Component
{
    use WithFileUploads;

    //String
    public $fileUpload, $folderName, $uploadedFileName, $discountType, $selectedCoach = '', $registrationType;
    //Boolean
    public $showProgressBar = false, $isDiscountApply, $isEarlyBirdPhase, $isSubmitActive;
    //Interger
    public $batchId, $price, $amountDisc, $totalPrice, $quotaLeft, $selectedProgram = '', $selectedLevel, $selectedClass = '', $priceAfterDisc;
    //Object
    public $referralMembers;

    protected RegistrationService $registrationService;
    protected BatchService $batchService;

    #[Computed]
    public function programs() {
        return Program::where('program_status', 'Open')->where('program_type', 'Reguler')->get();
    }

    #[Computed]
    public function coaches() {
        return Pricelist::showCoachBasedOnProgram($this->selectedProgram);
    }

    #[Computed]
    public function classes() {
        return ClassModel::where('coach_code', $this->selectedCoach)
        ->where('class_status','Open')
        ->where('program_id', $this->selectedProgram)
        ->get();
    }

    #[Computed]
    public function coach() {
        return Coach::where('code', $this->selectedCoach)->first();
    }

    //HOOK - execute every time component is rendered
    public function boot(RegistrationService $registrationService, BatchService $batchService) {
        $this->registrationService = $registrationService;
        $this->batchService = $batchService;
    }

    //HOOK - execute once when component is rendered
    public function mount() {
        $this->batchId = $this->batchService->batchIdActive();
    }

    //HOOK - execute when property is modified
    public function updated($property) {
        $this->isFormFilled();

        if ($property == 'selectedProgram') {
            $this->reset('selectedLevel', 'selectedCoach', 'selectedClass', 'quotaLeft');
        }

        if ($property == 'selectedCoach') {
            $this->reset('selectedClass', 'quotaLeft');
        }

        if ($property == 'selectedClass') {
            $this->quotaLeft = $this->registrationService->quotaLeft($this->selectedProgram, $this->selectedLevel, $this->coach->id, $this->selectedClass, $this->batchId);

            $pricelist = Pricelist::where('program_id', $this->selectedProgram)
                ->where('coach_code', $this->selectedCoach)
                ->first();

            $this->price = $pricelist->price_session_27_new;

            // Cek apakah tanggal daftar kurang dari tanggal buka batch
            $batch = $this->batchService->batchQuery();
            $openDate = $batch->early_bird_end;
            $dateToday = Carbon::now()->format('Y-m-d');

            //Check if there is a referral code applied
            $this->referralMembers = ReferralRegistration::discountReferrals(Auth::user()->email, $this->batchId);

            if ($dateToday <= $openDate) {
                $this->isDiscountApply = true;
                $this->amountDisc = $this->discount;
                $this->priceAfterDisc = $this->price - $this->amountDisc;
                $this->totalPrice = $this->priceAfterDisc;
                $this->discountType = 'Early Bird';
                $this->registrationType = 'Early Bird';
                $this->isEarlyBirdPhase = true;
            } else {
                if ($this->referralMembers->count() > 0) {
                    $this->isDiscountApply = true;
                    $this->amountDisc = $this->referralMembers->sum('discount');
                    $this->priceAfterDisc = $this->price - $this->amountDisc;
                    $this->totalPrice = $this->priceAfterDisc;
                    $this->discountType = 'Referral';
                } else {
                    $this->isDiscountApply = false;
                    $this->priceAfterDisc = $this->price;
                    $this->totalPrice = $this->price;
                }
                $this->registrationType = 'Reguler';
                $this->isEarlyBirdPhase = false;
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
    }

    //ACTION - show prgress bar when user upload file
    public function selectFile() {
        $this->showProgressBar = true;
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->selectedProgram) && !empty($this->selectedCoach) && !empty($this->selectedClass) && !empty($this->fileUpload)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    //ACTION - Submit form
    public function register() {

        DB::beginTransaction();
        try {
            if ($this->referralMembers->count() > 0 && $this->isEarlyBirdPhase == true) {
                ReferralRegistration::where('member_code', Auth::user()->email)
                ->where('batch_id', $this->batchId)
                ->where('is_cashback', 0)
                ->update([
                    'is_cashback' => 1,
                    'is_used' => 0
                ]);
            }

            Registration::create([
                'member_code' => Auth::user()->email,
                'batch_id' => $this->batchId,
                'amount_pay' => $this->totalPrice,
                'admin_fee' => 0,
                'program_price' => $this->price,
                'file_upload' => $this->fileUpload->storeAs($this->batchId, $this->uploadedFileName, 'public'),
                'payment_status' => 'Process',
                'registration_category' => 'New Member',
                'registration_type' => $this->registrationType,
                'program_id' => $this->selectedProgram,
                'level_id' => 1,
                'coach_id' => $this->coach->id,
                'class_id' => $this->selectedClass,
            ]);

            DB::commit();
            session()->flash('registrationSuccess', 'Success');
            $this->redirect('/member/renewal-registration', navigate:true);
        } catch (Exception) {
            DB::rollBack();
            session()->flash('failed-registration', 'Daftar Gagal, Cek Koneksi dan Kolom Isian Anda');
            $this->redirect('/member/renewal-registration', navigate:true);
        }

    }

    public function render()
    {
        return view('livewire.member.form-new-member-internal');
    }
}
