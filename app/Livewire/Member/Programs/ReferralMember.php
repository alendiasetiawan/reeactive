<?php

namespace App\Livewire\Member\Programs;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\ReferralRegistration;
use App\Services\BatchService;
use Illuminate\Support\Facades\Auth;

class ReferralMember extends Component
{
    //Integer
    public $selectedBatch;
    //String
    public $memberCode;

    #[Layout('layouts.app')]
    #[Title('Referral Member')]

    //HOOK - Execute once when component is rendered
    public function mount(BatchService $batchService) {
        $this->memberCode = Auth::user()->email;
        $this->selectedBatch = $batchService->batchIdActive();
    }

    //PROPERTY - List of members registered using referral code
    #[Computed]
    public function referralMembers() {
        return ReferralRegistration::getReferralMember($this->memberCode, $this->selectedBatch);
    }

    public function render()
    {
        return view('livewire.member.programs.referral-member');
    }
}
