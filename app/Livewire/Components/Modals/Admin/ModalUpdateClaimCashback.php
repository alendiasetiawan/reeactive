<?php

namespace App\Livewire\Components\Modals\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\ReferralRegistration;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ModalUpdateClaimCashback extends Component
{
    //String
    public $idModal;
    //Integer
    public $realId, $statusClaim;

    #[Computed]
    public function dataReferral() {
        return ReferralRegistration::takeOneMemberReferral($this->realId);
    }

    //LISTENER - Execute whene user click modal claim cashback
    #[On('set-data-update-cashback')]
    public function dataClaimCashBack($id) {
        try {
            $this->realId = Crypt::decrypt($id);
        } catch (DecryptException) {
            session()->flash('invalid-id', 'Stop! Dilarang Melakukan Modifikasi ID Parameter');
        }

        $this->dataReferral();
        $this->statusClaim = $this->dataReferral()->is_used;
    }

    //ACTION - Save data status claim cashback
    public function saveStatusClaim() {
        ReferralRegistration::where('id', $this->realId)
        ->update([
            'is_used' => $this->statusClaim
        ]);

        $this->dispatch('success-update-status-claim');
        $this->redirect(route('admin::registered_by_referral'), navigate:true);
        session()->flash('save-status-claim', 'Status claim cashback sudah diupdate');
    }

    public function render()
    {
        return view('livewire.components.modals.admin.modal-update-claim-cashback');
    }
}
