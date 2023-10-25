<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Coach;
use App\Models\Voucher;
use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\WorkshopRegistration;

class WorkshopPaymentVerification extends Component
{
    #[Layout('layouts.app')]
    #[Title('Verifikasi Transfer Workshop')]

    public object $payments;
    public object $vouchers;
    public int $workshopBatchId;

    protected $batchService;

    public function mount(BatchService $batchService) {
        $workshopQuery = $batchService->workshopBatchQuery();
        $this->workshopBatchId = $workshopQuery->id;
        $this->payments = WorkshopRegistration::allWorkshopRegistrations($this->workshopBatchId);
        $this->vouchers = Voucher::voucherUsed($this->workshopBatchId);
    }

    #[Computed]
    public function workshopMembers() {
        return Coach::membersWorkshop($this->workshopBatchId);
    }

    public function render()
    {
        return view('livewire.admin.registrations.workshop-payment-verification');
    }
}
