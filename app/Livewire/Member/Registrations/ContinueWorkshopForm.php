<?php

namespace App\Livewire\Member\Registrations;

use Exception;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\Member;
use App\Models\WorkshopBatch;
use Livewire\WithFileUploads;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\WorkshopRegistration;
use Illuminate\Support\Facades\Auth;
use App\Services\RegistrationService;

class ContinueWorkshopForm extends Component
{
    use WithFileUploads;

    #[Layout('layouts.app')]
    #[Title('Form Lanjutan Program Workshop')]

    public bool $showProgressBar = false;
    public $fileUpload;
    public $uploadedFileName;
    public object $program;
    public string $assessmentStatus;
    public int $priceNumber;
    public string $price;
    public string $normalPrice;
    public bool $isBatchOpen;
    public int $quotaLeft;
    public bool $userExist;
    public bool $isAssessment;
    public $batchQuery;

    protected $batchService;
    protected $registrationService;

    public function boot(BatchService $batchService, RegistrationService $registrationService)
    {
        $this->batchService = $batchService;
        $this->registrationService = $registrationService;
    }

    public function mount(BatchService $batchService) {
        $this->batchQuery = $batchService->workshopBatchQuery();
        $batchId = $this->batchQuery->id;
        $this->program = Program::find(8);

        //Check batch status
        $this->isBatchOpen = WorkshopBatch::where('batch_status', 'Open')->exists();

        //Check assessment status
        $registrationData = WorkshopRegistration::where('member_code', Auth::user()->email)
        ->where('workshop_batch_id', $batchId)
        ->first();
        $this->isAssessment = $registrationData->is_assessment;
        $this->assessmentStatus = $this->registrationService->checkAssessmentStatus($batchId);

        //Check assessment price
        $priceList = Pricelist::where('program_id', 8)->first();
        if ($this->assessmentStatus == 'Belum') {
            $this->priceNumber = $priceList->price;
        } else {
            $this->priceNumber = $priceList->price_renewal;
            $normalPriceNumber = $priceList->price;
            $this->normalPrice = 'Rp '.number_format($normalPriceNumber,0,',','.');
        }
        $this->price = 'Rp '.number_format($this->priceNumber,0,',','.');

        //Check quota
        $this->quotaLeft = $this->registrationService->quotaWorkshop(8, 9);

        //Check username exist
        $this->userExist = WorkshopRegistration::where('member_code', Auth::user()->email)
        ->where('program_id', 8)
        ->where('workshop_batch_id', $batchId)
        ->exists();
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

    public function saveData() {
        $this->quotaLeft = $this->registrationService->quotaWorkshop(8, 9);
        $classData = ClassModel::where('program_id', 8)->first();
        $selectedClass = $classData->id;

        if ($this->quotaLeft <= 0) {
            session()->flash('fullQuota', 'Daftar Gagal! Quota pendaftaran sudah penuh, silahkan pilih program yang lain');
            $this->redirect(route('continue_workshop_form'), navigate:true);
        } else {
            try {
                WorkshopRegistration::create([
                    'member_code' => Auth::user()->email,
                    'workshop_batch_id' => $this->batchQuery->id,
                    'amount_pay' => $this->priceNumber,
                    'file_upload' => $this->fileUpload->storeAs($this->batchQuery->id, $this->uploadedFileName, 'public'),
                    'payment_status' => 'Process',
                    'registration_category' => 'Renewal Member',
                    'is_assessment' => $this->isAssessment,
                    'program_id' => 8,
                    'coach_id' => 9,
                    'class_id' => $selectedClass,
                ]);
                session()->flash('register-success', true);
                $this->redirect(route('member::continue_workshop_form'), navigate:true);
            } catch (Exception) {
                session()->flash('failed', 'Daftar Gagal, Cek Koneksi dan Kolom Isian Anda');
                $this->redirect(route('member::continue_workshop_form'), navigate:true);
            }
        }


    }

    public function render()
    {
        return view('livewire.member.registrations.continue-workshop-form');
    }
}
