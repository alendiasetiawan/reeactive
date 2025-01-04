<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use Livewire\Component;
use App\Models\Registration;
use App\Services\BatchService;
use Detection\MobileDetect;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class PaymentVerification extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Verifikasi Transfer Program Reguler')]

    public $batchId;
    public $batchName;
    public $searchMember = '';
    public $transferStatus = '';
    public $isTablet;
    public $limitData = 9;
    public $totalPaymentDone, $totalPaymentProcess, $totalPaymentInvalid;

    protected $batchService;

    #[Computed]
    public function payments() {
        return Registration::allRegistrationOpen($this->batchId, $this->searchMember, $this->transferStatus, $this->limitData);
    }

    public function boot(BatchService $batchService, MobileDetect $mobileDetect) {
        $this->batchId = $batchService->batchIdActive();
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;
        $mobileDetect->isTablet() ? $this->isTablet = true : $this->isTablet = false;
        $this->totalPaymentDone = Registration::where('batch_id', $this->batchId)->where('payment_status', 'Done')->count();
        $this->totalPaymentProcess = Registration::where('batch_id', $this->batchId)->where('payment_status', 'Process')->count();
        $this->totalPaymentInvalid = Registration::where('batch_id', $this->batchId)->where('payment_status', 'Invalid')->count();
    }

    public function loadMore() {
        $this->limitData += 18;
    }

    public function render()
    {
        // return view('livewire.admin.payment-verification');
        return view('livewire.admin.vuexy-payment-verification');
    }
}
