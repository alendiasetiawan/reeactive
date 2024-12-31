<?php

namespace App\Livewire\Member;

use Exception;
use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Coach;
use App\Models\Level;
use App\Models\Program;
use Livewire\Component;
use App\Models\Referral;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\ClassSession;
use App\Models\Registration;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use App\Models\VoucherMerchandise;
use Illuminate\Support\Facades\DB;
use App\Models\ReferralRegistration;
use Illuminate\Support\Facades\Auth;
use App\Services\RegistrationService;

class RenewalForm extends Component
{
    use WithFileUploads;

    #[Locked]
    public $batchId;

    public $batchOpen;
    public $batchName;
    public $fileUpload;
    public $selectedProgram;
    public $selectedCoach;
    public $selectedClass;
    public $selectedLevel = 1;
    public $price;
    public $levels;
    public $isDiscountApply = false, $showProgressBar = false, $isEarlyBirdPhase;
    public $uploadedFileName;
    public $registrationCategory;
    public $programs;
    public $quotaLeft;
    public $alertQuota = false;
    public $registeredMember;
    public $selectedSession;
    public ?int $amountDisc, $priceAfterDisc, $totalPrice;
    //Object
    public $batch, $referralMembers;
    public $discount;
    public $registrationType, $discountType;
    public $voucherValidDate;

    protected $registrationService;

    public function mount(BatchService $batchService) {
        $this->batch = $batchService->batchQuery();
        $this->discount = $this->batch->disc_early_bird;
        $this->voucherValidDate = Carbon::parse($this->batch->start_date)->addDays(90)->format('Y-m-d');
    }

    public function boot(RegistrationService $registrationService) {
        $this->programs = Program::where('program_status', 'Open')->where('program_type', 'Reguler')->get();
        $batch = Batch::orderBy('id', 'desc')->first();
        $this->batchId = $batch->id;
        $this->batchName = $batch->batch_name;
        $this->levels = Level::pluck('level_name', 'id');
        $this->registrationService = $registrationService;
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
    public function classSessions() {
        return ClassSession::where('program_id', $this->selectedProgram)
        ->where('status', 'Open')
        ->get();
    }

    #[Computed]
    public function coach() {
        return Coach::where('code', $this->selectedCoach)->first();
    }

    public function updated($property) {
        if ($property == 'selectedProgram') {
            $this->reset('selectedLevel', 'selectedCoach', 'selectedClass', 'quotaLeft');
        }

        if($property == 'selectedSession') {
            $this->reset('selectedCoach', 'selectedClass');
        }

        if ($property == 'selectedCoach') {
            $this->reset('selectedClass', 'quotaLeft');
        }

        if ($property == 'selectedClass') {
            $this->quotaLeft = $this->registrationService->quotaLeft($this->selectedProgram, $this->selectedLevel, $this->coach->id, $this->selectedClass, $this->batchId);

            if ($this->quotaLeft <= 0) {
                $this->alertQuota = true;
            } else {
                $this->alertQuota = false;
            }

            $member = Registration::where('member_code', Auth::user()->email)
            ->orderBy('id', 'asc')
            ->limit(1)
            ->first();
            $pricelist = Pricelist::where('program_id', $this->selectedProgram)
                ->where('coach_code', $this->selectedCoach)
                ->first();

            if ($member->batch_id <= 2) {
                $this->price = $pricelist->price_session_27_old;
            } else {
                $this->price = $pricelist->price_session_27_new;
            }

            // Cek apakah tanggal daftar kurang dari tanggal buka batch
            $openDate = $this->batch->early_bird_end;
            $dateToday = Carbon::now()->format('Y-m-d');

            //Check if there is a referral code applied
            $this->referralMembers = ReferralRegistration::discountReferrals(Auth::user()->email, $this->batchId);

            if (($dateToday <= $openDate) && ($this->selectedProgram == 5)) {
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

    public function selectFile() {
        $this->showProgressBar = true;
        $this->coaches = Pricelist::showCoachBasedOnProgram($this->selectedProgram);
        $this->classes = ClassModel::where('coach_code', $this->selectedCoach)->get();
    }

    public function getCheckBatchProperty() {
        $checkBatch = Batch::checkRegisteredBatch();

        return $checkBatch;
    }

    public function saveData() {

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

            $registration = Registration::create([
                'member_code' => Auth::user()->email,
                'batch_id' => $this->batchId,
                'amount_pay' => $this->totalPrice,
                'admin_fee' => 0,
                'program_price' => $this->price,
                'file_upload' => $this->fileUpload->storeAs($this->batchId, $this->uploadedFileName, 'public'),
                'payment_status' => 'Process',
                'registration_category' => $this->registrationCategory,
                'registration_type' => $this->registrationType,
                'program_id' => $this->selectedProgram,
                'level_id' => $this->selectedLevel,
                'coach_id' => $this->coach->id,
                'class_id' => $this->selectedClass,
            ]);

            //Create voucher code
            VoucherMerchandise::generateVoucherMerchandise($this->batch->id, Auth::user()->email, $this->voucherValidDate, $registration->id);

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
        $data = [
            'checkBatch' => $this->checkBatch,
        ];

        return view('livewire.member.renewal-form', $data);
    }
}
