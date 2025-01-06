<?php

namespace App\Livewire\Components\Modals;

use Exception;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Registration;
use Livewire\WithFileUploads;
use Livewire\Attributes\Reactive;
use App\Models\SpecialRegistration;
use App\Services\BatchService;
use Illuminate\Support\Facades\Storage;

class InvalidPayment extends Component
{
    use WithFileUploads;

    #[Reactive]
    public $registrationId, $modalInvalidType;
    //String
    public $modalId, $fileUpload, $folderName, $uploadedFileName, $invalidReason;
    //Object
    public $detailRegistration;
    //Boolean
    public $showProgressBar, $isSubmitActive = false;

    protected $rules = [
        'fileUpload' => 'mimes:png,jpg,jpeg|max:1024',
    ];

    protected $messages = [
        'fileUpload.max' => 'Ukuran file tidak boleh lebih dari 1 MB.',
        'fileUpload.mimes' => 'File harus dalam format gambar: .jpg/.jpeg/.png.',
    ];

    public function boot(BatchService $batchService) {
        if ($this->modalInvalidType == 'Special Program') {
            $this->detailRegistration = SpecialRegistration::where('id', $this->registrationId)->first();
            $this->folderName = Carbon::now()->isoFormat('MMMM Y');
        } else {
            $this->detailRegistration = Registration::where('id', $this->registrationId)->first();
            $this->folderName = $batchService->batchIdActive();
        }

        $this->invalidReason = $this->detailRegistration?->invalid_reason;
        $this->folderName = Carbon::now()->isoFormat('MMMM Y');
    }

    //HOOK - Execute when property updated
    public function updated($property) {
        $this->isFormFilled();
        if ($property == 'fileUpload') {
            $this->uploadedFileName = time().'.'.$this->fileUpload->extension();
            $this->validateOnly('fileUpload');
        }
    }

    //ACTION - show prgress bar when user upload file
    public function selectFile() {
        $this->showProgressBar = true;
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->fileUpload)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    //ACTION - Upload file from user
    public function uploadPayment() {
        try {
            //Delete old file
            if ($this->detailRegistration->file_upload && Storage::disk('public')->exists($this->detailRegistration->file_upload)) {
                Storage::disk('public')->delete($this->detailRegistration->file_upload);
            }

            if ($this->modalInvalidType == 'Special Program') {
                SpecialRegistration::where('id', $this->registrationId)
                ->update([
                    'file_upload' => $this->fileUpload->storeAs($this->folderName, $this->uploadedFileName, 'public'),
                    'payment_status' => 'Process',
                    'invalid_reason' => null
                ]);
            } else {
                Registration::where('id', $this->registrationId)
                ->update([
                    'file_upload' => $this->fileUpload->storeAs($this->folderName, $this->uploadedFileName, 'public'),
                    'payment_status' => 'Process',
                    'invalid_reason' => null
                ]);
            }

            session()->flash('re-upload-success', 'Upload bukti transfer berhasil, silahkan tunggu konfirmasi dari admin');
            $this->redirect(route('member::dashboard'));
        } catch (Exception) {
            session()->flash('error-upload', 'Upload bukti transfer gagal, silahkan coba lagi!');
        }
    }

    public function render()
    {
        return view('livewire.components.modals.invalid-payment');
    }
}
