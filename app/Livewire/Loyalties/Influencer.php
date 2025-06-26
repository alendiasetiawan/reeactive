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

class Influencer extends Component
{
    #[Title('Database Influencer')]

    //Boolean
    public $isMobile;
    //Integer
    public $limitData = 6, $selectedIdInfluencer;
    //Object
    public $fetchInfluencer;

    //LISTENER - Refresh data after add new influencer
    #[On('add-influencer-success', 'add-referral-code-success', 'delete-influencer-success')]
    public function refreshData() {
        $this->unsetCachedProperty();
    }

    #[Computed(persist: true, seconds:1800)]
    public function listInfluencers() {
        return InfluencerQuery::paginateListInfluencers($this->limitData);
    }

    #[Computed(persist: true, seconds:1800)]
    public function totalInfluencer() {
        return InfluencerModel::count();
    }

    //HOOK - Execute every time component is rendered
    public function boot(MobileDetect $mobileDetect) {
        $this->isMobile = $mobileDetect->isMobile();
    }

    //ACTION - Load more data
    public function loadMore() {
        $this->limitData += 9;
    }

    //ACTION - Unset cached property
    public function unsetCachedProperty() {
        unset($this->listInfluencers);
        unset($this->totalInfluencer);
    }

    //ACTION - Confirmation delete data influencer
    public function setIdInfluencer($id) {
        try {
            $this->selectedIdInfluencer = Crypt::decrypt($id);
            $this->fetchInfluencer = InfluencerModel::find($this->selectedIdInfluencer);
        } catch (\Throwable $th) {
            session()->flash('error-selected-id', 'Stop! Dilarang melakukan modifikasi ID Paramater');
        }
    }

    //ACTION - Set id and event for edit influencer
    public function setIdEditInfluencer($id) {
        $this->setIdInfluencer($id);
        $this->dispatch('event-edit-influencer');
    }



    public function render()
    {
        return view('livewire.loyalties.influencer')->layout('layouts.vuexy-app');
    }
}
