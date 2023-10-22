<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Voucher;
use App\Models\WorkshopRegistration;
use App\Services\BatchService;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class WorkshopPaymentVerification extends Component
{
    #[Layout('layouts.app')]
    #[Title('Verifikasi Transfer Workshop')]

    public object $payments;
    public object $vouchers;

    protected $batchService;

    public function mount(BatchService $batchService) {
        $workshopQuery = $batchService->workshopBatchQuery();
        $workshopBatchId = $workshopQuery->id;
        $this->payments = WorkshopRegistration::allWorkshopRegistrations($workshopBatchId);
        $this->vouchers = Voucher::voucherUsed($workshopBatchId);
    }

    public function render()
    {
        return view('livewire.admin.registrations.workshop-payment-verification');
    }
}
