<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use App\Models\InfluencerReferral;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use App\Queries\InfluencerReferralQuery;

class ModalDeleteReferralCodeInfluencer extends Component
{
    //String
    public $modalId;
    //Integer
    public $decryptedId;
    //Object
    public $querySelectedReferral;


    //LISTENER - Take action when event delete referral code is triggered
    #[On('event-delete-referral-code')]
    public function setValueDeleteReferral($id) {
        //Try to decrypt id
        try {
            $this->decryptedId = Crypt::decrypt($id);
        } catch (\Throwable $th) {
            session()->flash('error-decrypt-id', 'Stop! Dilarang melakukan modifikasi ID Paramater');
        }

        //When id is decrypted, run query and set value
        try {
            $this->querySelectedReferral = InfluencerReferralQuery::fetchDetailReferral($this->decryptedId);
        } catch (\Throwable $th) {
            Log::error('Gagal mengambil data detail referral:'. $th->getMessage());
            session()->flash('error-set-value', 'Ups.. Gagal menampilkan data, silahkan coba lagi!');
        }
    }

    //ACTION - Execute delete referral code
    public function deleteReferralCode() {
        try {
            InfluencerReferral::where('id', $this->decryptedId)->delete();
            $this->dispatch('delete-referral-code-success');
            $this->redirect(route('admin::loyalty.endorse.influencer_referral_code'), navigate:true);
        } catch (\Throwable $th) {
            Log::error('Gagal menghapus kode referral:'. $th->getMessage());
            session()->flash('delete-referral-failed', 'Ups.. Gagal menghapus data, silahkan coba lagi!');
        }
    }

    public function render()
    {
        return view('livewire.components.modals.admin.royalties.modal-delete-referral-code-influencer');
    }
}
