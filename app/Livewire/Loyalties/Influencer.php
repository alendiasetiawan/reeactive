<?php

namespace App\Livewire\Loyalties;

use Livewire\Component;
use Detection\MobileDetect;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use App\Queries\InfluencerQuery;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use App\Models\Influencer as InfluencerModel;
use Livewire\WithComputed;

class Influencer extends Component
{
    // use WithComputed;
    #[Title('Database Influencer')]

    //Boolean
    public $isMobile;
    //Integer
    public $limitData = 6, $selectedIdInfluencer, $refreshKey = 0;

    #[Computed(persist: true)]
    public function listInfluencers() {
        return InfluencerQuery::paginateListInfluencers($this->limitData);
    }

    #[Computed(persist: true)]
    public function totalInfluencer() {
        return InfluencerModel::count();
    }

    //HOOK - Execute every time component is rendered
    public function boot(MobileDetect $mobileDetect) {
        $this->isMobile = $mobileDetect->isMobile();
        $this->unsetCachedProperty();
    }

    //ACTION - Load more data
    public function loadMore() {
        $this->limitData += 9;
    }

    //ACTION - Unset cached property
    public function unsetCachedProperty() {
        unset($this->listInfluencers, $this->totalInfluencer);
    }

    //ACTION - Confirmation delete data influencer
    public function setIdInfluencer($id) {
        try {
            $this->selectedIdInfluencer = Crypt::decrypt($id);
        } catch (\Throwable $th) {
            session()->flash('error-selected-id', 'Stop! Dilarang melakukan modifikasi ID Paramater');
        }
    }

    //ACTION - Set id and event for edit influencer
    public function setIdEditInfluencer($id) {
        $this->setIdInfluencer($id);
        $this->dispatch('event-edit-influencer');
    }

    //ACTION - Set id and event for add referral code
    public function setIdInfluencerReferral($id) {
        $this->setIdInfluencer($id);
        $this->dispatch('event-add-referral-code');
    }

    //ACTION - Set id and event for delete influencer
    public function setIdDeleteInfluencer($id) {
        $this->setIdInfluencer($id);
        $this->dispatch('event-delete-influencer');
    }

    public function render()
    {
        return view('livewire.loyalties.influencer')->layout('layouts.vuexy-app');
    }
}
