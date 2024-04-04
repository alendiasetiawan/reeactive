<?php

namespace App\Livewire\Member;

use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Coach;
use App\Models\Level;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\ClassSession;
use App\Models\Registration;
use App\Services\BatchService;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
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
    public bool $isDiscountApply = false, $showProgressBar = false;
    public $uploadedFileName;
    public $registrationCategory;
    public $programs;
    public $quotaLeft;
    public $alertQuota = false;
    public $registeredMember;
    public $selectedSession;
    public ?int $amountDisc, $priceAfterDisc, $totalPrice;
    public object $batch;
    public $discount;
    public ?string $registrationType;

    protected $registrationService;

    public function mount(BatchService $batchService) {
        $this->batch = $batchService->batchQuery();
        $this->discount = $this->batch->disc_early_bird;
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
            $openDate = $this->batch->start_date;
            $dateToday = Carbon::now()->format('Y-m-d');

            if ($dateToday < $openDate) {
                $this->isDiscountApply = true;
                $this->amountDisc = $this->price * $this->discount;
                $this->priceAfterDisc = $this->price - $this->amountDisc;
                $this->totalPrice = $this->priceAfterDisc;
                $this->registrationType = 'Early Bird';
            } else {
                $this->isDiscountApply = false;
                $this->priceAfterDisc = $this->price;
                $this->totalPrice = $this->price;
                $this->registrationType = 'Reguler';
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
        Registration::insert([
            'member_code' => Auth::user()->email,
            'batch_id' => $this->batchId,
            'amount_pay' => $this->totalPrice,
            'admin_fee' => 0,
            'program_price' => $this->priceAfterDisc,
            'file_upload' => $this->fileUpload->storeAs($this->batchId, $this->uploadedFileName, 'public'),
            'payment_status' => 'Process',
            'registration_category' => $this->registrationCategory,
            'registration_type' => $this->registrationType,
            'program_id' => $this->selectedProgram,
            'level_id' => $this->selectedLevel,
            'coach_id' => $this->coach->id,
            'class_id' => $this->selectedClass,
        ]);

        session()->flash('registrationSuccess', 'Success');
        $this->redirect('/member/renewal-registration', navigate:true);

    }

    public function render()
    {
        $data = [
            'checkBatch' => $this->checkBatch,
        ];

        return view('livewire.member.renewal-form', $data);
    }
}
