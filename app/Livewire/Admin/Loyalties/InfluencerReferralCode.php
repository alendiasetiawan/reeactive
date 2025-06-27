<?php

namespace App\Livewire\Admin\Loyalties;

use App\Queries\InfluencerReferralQuery;
use Livewire\Component;
use Detection\MobileDetect;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

class InfluencerReferralCode extends Component
{
    #[Title('Influencer Referral Code')]

    //Boolean
    public $isMobile;
    //Integer
    public $selectedInfluencerId = null, $limitData = 9;

    #[Computed(persist: true)]
    public function paginateReferralCodes() {
        return InfluencerReferralQuery::paginateReferralCodes($this->limitData, $this->selectedInfluencerId);
    }

    //HOOK - Execute once when component is rendered
    public function mount(MobileDetect $mobileDetect) {
        $this->isMobile = $mobileDetect->isMobile();
    }

    public function render()
    {
        return view('livewire.admin.loyalties.influencer-referral-code')->layout('layouts.vuexy-app');
    }
}
