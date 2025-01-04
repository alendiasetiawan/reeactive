<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Member;
use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use App\Services\MemberService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\ReferralRegistration;

class RegisteredByReferral extends Component
{
    //Object
    public $lastBatches;
    //Integer
    public $limitData = 9, $selectedBatch;
    //String
    public $searchMember = null;

    protected MemberService $memberService;
    protected BatchService $batchService;

    #[Title('Member Claim Referral')]
    #[Layout('layouts.vuexy-app')]

    //HOOK - Execute once when component is rendered
    public function mount() {
        $this->lastBatches = $this->batchService->getLastBatch();
        $this->selectedBatch = $this->batchService->batchIdActive();
    }

    //HOOK - Execute every time component is rendered
    public function boot(BatchService $batchService, MemberService $memberService) {
        $this->memberService = $memberService;
        $this->batchService = $batchService;
    }

    //PROPERTY - List of members that has new member registered using referral code
    #[Computed]
    public function upReferralMembers() {
        return $this->memberService->paginateMemberClaimReferral($this->selectedBatch, $this->limitData, $this->searchMember);
    }

    //PROPERTY - Count how many existing member that has new member registered using referral code
    #[Computed]
    public function countTotalReferralMembers() {
        return ReferralRegistration::distinct()
        ->where('batch_id', $this->selectedBatch)
        ->count('member_code');
    }

    //ONCLICK - Load more data
    public function loadMore() {
        $this->limitData += 9;
    }

    public function render()
    {
        // return view('livewire.admin.registrations.registered-by-referral');
        return view('livewire.admin.registrations.vuexy-registered-by-referral');
    }
}
