<?php

namespace App\Livewire\Member\Programs;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\ReferralRegistration;
use App\Services\BatchService;
use Detection\MobileDetect;
use Illuminate\Support\Facades\Auth;

class ReferralMember extends Component
{
    //Integer
    public $selectedBatch, $limitData = 2;
    //String
    public $memberCode;
    //Boolean
    public $isMobile;
    //Object
    public $lastBatches;

    #[Layout('layouts.app')]
    #[Title('Referral Member')]

    //HOOK - Execute once when component is rendered
    public function mount(BatchService $batchService, MobileDetect $mobileDetect) {
        $this->memberCode = Auth::user()->email;
        $this->selectedBatch = $batchService->batchIdActive();
        $this->isMobile = $mobileDetect->isMobile();
        $this->lastBatches = $batchService->getLastBatch();
    }

    //PROPERTY - List of members registered using referral code
    #[Computed]
    public function referralMembers() {
        return ReferralRegistration::getReferralMember($this->memberCode, $this->selectedBatch, $this->limitData);
    }

    //PROPERTY - Sum discount get by user
    #[Computed]
    public function totalDiscount() {
        return ReferralRegistration::sumDiscount($this->memberCode, $this->selectedBatch);
    }

    //PROPERTY - Sum casback get by user
    #[Computed]
    public function totalCashback() {
        return ReferralRegistration::sumCashback($this->memberCode, $this->selectedBatch);
    }

    public function render()
    {
        return view('livewire.member.programs.referral-member');
    }
}
