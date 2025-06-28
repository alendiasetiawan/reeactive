<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Influencer;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use App\Models\InfluencerReferral;
use App\Queries\InfluencerQuery;
use Illuminate\Support\Facades\Log;

class ModalAddReferralInfluencer extends Component
{
    //String
    public $modalType, $modalId, $referralCode, $expiredDate, $discount;
    //Integer
    public $influencerId = '', $usedLimit;
    //Boolean
    public $status, $isSubmitActivated = false;
    //Collection
    public $listInfluencers;
    //Object
    public $queryReferral;

    //LISTENER - Listeting to event add referral code
    #[On('event-add-edit-referral-code')]
    public function setModalType($modalType) {
        $this->modalType = $modalType;
        $this->expiredDate = Carbon::now()->addDays(14)->format('Y-m-d');
        $this->status = 1;
    }

    //HOOK - Execute when property is changed
    public function updated() {
        $this->isFormFilled();
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->influencerId) && !empty($this->referralCode) && !empty($this->usedLimit) && !empty($this->discount)) {
            $this->isSubmitActivated = true;
        } else {
            $this->isSubmitActivated = false;
        }
    }

    //ACTION - Save referral code
    public function saveReferralCode() {
        try {
            InfluencerReferral::updateOrCreate([
                'id' => $this->queryReferral?->id
            ], [
                'influencer_id' => $this->influencerId,
                'code' => $this->referralCode,
                'is_active' => $this->status,
                'expired_date' => $this->expiredDate,
                'used_limit' => $this->usedLimit,
                'discount' => preg_replace("/[^0-9]/", "", $this->discount),
            ]);

            $this->dispatch('add-referral-code-success');
            $this->redirect(route('admin::loyalty.endorse.influencer_referral_code'), navigate:true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan data referral code:'. $th->getMessage());
            session()->flash('error-add-referral-code', 'Terjadi kesalahan saat menyimpan, silahkan coba kembali!');
        }
    }

    public function render()
    {
        return view('livewire.components.modals.admin.royalties.modal-add-referral-influencer');
    }
}
