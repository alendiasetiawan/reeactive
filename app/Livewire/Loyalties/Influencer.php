<?php

namespace App\Livewire\Loyalties;

use Livewire\Component;
use Detection\MobileDetect;
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
    public $totalInfluencer, $limitData = 6, $selectedIdInfluencer;
    //Object
    public $fetchInfluencer;

    #[Computed]
    public function listInfluencers() {
        return InfluencerQuery::paginateListInfluencers($this->limitData);
    }

    #[Computed]
    public function totalInfluencer() {
        return InfluencerModel::count();
    }

    public function boot(MobileDetect $mobileDetect) {
        $this->isMobile = $mobileDetect->isMobile();
    }

    public function loadMore() {
        $this->limitData += 9;
    }

    //ACTION - Confirmation delete data influencer
    public function setIdDeleteInfluencer($id) {
        try {
            $this->selectedIdInfluencer = Crypt::decrypt($id);
            $this->fetchInfluencer = InfluencerModel::find($this->selectedIdInfluencer);
        } catch (\Throwable $th) {
            session()->flash('error-selected-id', 'Stop! Dilarang melakukan modifikasi ID Paramater');
        }
    }

    //ACTION - Delete data influencer
    public function deleteInfluencer() {
        try {
            InfluencerModel::find($this->selectedIdInfluencer)->delete();
            $this->dispatch('delete-influencer-success');
            $this->redirect(route('admin::influencer'), navigate:true);
        } catch (\Throwable $th) {
            Log::error('Gagal menghapus data influencer:'. $th->getMessage());
            session()->flash('error-delete-influencer', 'Terjadi kesalahan saat menghapus, silahkan coba kembali!');
        }
    }

    public function render()
    {
        return view('livewire.loyalties.influencer')->layout('layouts.vuexy-app');
    }
}
