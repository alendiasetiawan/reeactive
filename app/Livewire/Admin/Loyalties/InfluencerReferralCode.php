<?php

namespace App\Livewire\Admin\Loyalties;

use App\Models\Influencer;
use App\Models\InfluencerReferral;
use App\Queries\InfluencerQuery;
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
    public $selectedInfluencerId = '', $limitData = 9;
    //Collection
    public $listInfluencers;

    #[Computed]
    public function paginateReferralCodes() {
        return InfluencerReferralQuery::paginateReferralCodes($this->limitData, $this->selectedInfluencerId);
    }

    #[Computed]
    public function totalReferralCode() {
        return InfluencerReferral::count();
    }

    //HOOK - Execute once when component is rendered
    public function mount(MobileDetect $mobileDetect) {
        $this->isMobile = $mobileDetect->isMobile();
        $this->listInfluencers = InfluencerQuery::listActiveInfluencers();
    }

    //ACTION - Load more data
    public function loadMore() {
        $this->limitData += 9;
        unset($this->paginateReferralCodes);
    }

    public function render()
    {
        return view('livewire.admin.loyalties.influencer-referral-code')->layout('layouts.vuexy-app');
    }
}
