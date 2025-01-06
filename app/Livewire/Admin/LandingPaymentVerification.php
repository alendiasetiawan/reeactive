<?php

namespace App\Livewire\Admin;

use App\Models\Registration;
use App\Models\SpecialRegistration;
use App\Services\BatchService;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class LandingPaymentVerification extends Component
{
    #[Title('Portal Verifikasi Transfer')]
    #[Layout('layouts.vuexy-app')]

    //Integer
    public $totalWaitingReguler, $totalWaitingLepasan;

    public function mount(BatchService $batchService) {
        $batchId = $batchService->batchIdActive();
        $this->totalWaitingReguler = Registration::waitingVerification($batchId);
        $this->totalWaitingLepasan = SpecialRegistration::waitingVerification();
    }

    public function render()
    {
        return view('livewire.admin.landing-payment-verification');
    }
}
