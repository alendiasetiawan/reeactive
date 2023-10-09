<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use Livewire\Component;
use App\Models\Registration;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class PaymentVerification extends Component
{
    #[Layout('layouts.app')]
    #[Title('Verifikasi Transfer')]

    public $payments;
    public $batchId;
    public $batchName;

    protected $batchService;

    public function boot(BatchService $batchService) {
        $this->batchId = $batchService->batchIdActive();
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;
        $this->payments = Registration::allRegistrationOpen($this->batchId);
    }

    public function render()
    {
        return view('livewire.admin.payment-verification');
    }
}
