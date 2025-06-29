<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use App\Helpers\CurrencyHelper;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\InfluencerReferral;
use App\Queries\InfluencerReferralQuery;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class ModalAddReferralInfluencer extends Component
{
    //String
    public $modalType, $modalId, $referralCode, $expiredDate, $discount, $selectedId = null, $influencerName;
    //Integer
    public $influencerId = '', $usedLimit;
    //Boolean
    public $status, $isSubmitActivated = false;
    //Collection
    public $listInfluencers;
    //Object
    public $queryReferral;

    //LISTENER - Listeting to event add referral code
    #[On('event-add-referral-code')]
    public function setValueAddReferral() {
        $this->modalType = 'Add';
        $this->expiredDate = Carbon::now()->addDays(14)->format('Y-m-d');
        $this->status = 1;
    }

    //LISTENER - Take action when event edit referral code is triggered
    #[On('event-edit-referral-code')]
    public function setValueEditReferral($id) {
        $this->modalType = 'Edit';

        //Try to decrypt id
        try {
            $this->selectedId = Crypt::decrypt($id);
        } catch (\Throwable $th) {
            session()->flash('error-selected-id', 'Stop! Dilarang melakukan modifikasi ID Paramater');
        }

        //When id is decrypted, run query and set value to form
        try {
            $this->queryReferral = InfluencerReferralQuery::fetchDetailReferral($this->selectedId);
            $this->influencerId = $this->queryReferral->influencer_id;
            $this->referralCode = $this->queryReferral->code;
            $this->expiredDate = $this->queryReferral->expired_date;
            $this->status = $this->queryReferral->is_active;
            $this->usedLimit = $this->queryReferral->used_limit;
            $this->discount = CurrencyHelper::formatRupiah($this->queryReferral->discount);
            $this->influencerName = $this->queryReferral->influencer_name;
        } catch (\Throwable $th) {
            Log::error('Gagal mengambil data detail referral:'. $th->getMessage());
            session()->flash('error-set-value', 'Ups.. Server error, silahkan coba lagi!');
        }

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
                'id' => $this->selectedId
            ], [
                'influencer_id' => $this->influencerId,
                'code' => $this->referralCode,
                'is_active' => $this->status,
                'expired_date' => $this->expiredDate,
                'used_limit' => $this->usedLimit,
                'discount' => preg_replace("/[^0-9]/", "", $this->discount),
            ]);

            if ($this->modalType == 'Add') {
                $this->dispatch('add-referral-code-success');
            } else {
                $this->dispatch('edit-referral-code-success');
            }
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
