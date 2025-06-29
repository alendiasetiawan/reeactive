<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Influencer;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use App\Models\InfluencerReferral;
use Illuminate\Support\Facades\Log;

class ModalAddReferralPerInfluencer extends Component
{
    //String
    public $modalId, $referralCode, $expiredDate, $discount;
    //Integer
    public $usedLimit;
    //Object
    public $queryAddReferral;
    //Boolean
    public $isSubmitActivated = false, $status = 1;
    //Integer
    #[Reactive]
    public $selectedIdInfluencer;

    #[On('event-add-referral-code')]
    public function fetchData() {
        $this->queryAddReferral = Influencer::find($this->selectedIdInfluencer);
    }

    //HOOK - Execute every time component is rendered
    public function hydrate() {
        $this->expiredDate = Carbon::now()->addDays(14)->format('Y-m-d');
    }

    //HOOK - Execute when property is changed
    public function updated() {
        $this->isFormFilled();
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->referralCode) && !empty($this->usedLimit) && !empty($this->discount)) {
            $this->isSubmitActivated = true;
        } else {
            $this->isSubmitActivated = false;
        }
    }

    //ACTION - Save referral code
    public function saveReferralCode() {
        try {
            InfluencerReferral::create([
                'influencer_id' => $this->selectedIdInfluencer,
                'code' => $this->referralCode,
                'is_active' => $this->status,
                'expired_date' => $this->expiredDate,
                'used_limit' => $this->usedLimit,
                'discount' => preg_replace("/[^0-9]/", "", $this->discount),
            ]);

            $this->dispatch('add-referral-code-success');
            $this->redirect(route('admin::influencer'), navigate:true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan data referral code:'. $th->getMessage());
            session()->flash('error-add-referral-code', 'Terjadi kesalahan saat menyimpan, silahkan coba kembali!');
        }
    }


    public function render()
    {
        return view('livewire.components.modals.admin.royalties.modal-add-referral-per-influencer');
    }
}
