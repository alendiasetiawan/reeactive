<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use App\Livewire\Loyalties\Influencer as LoyaltiesInfluencer;
use Livewire\Component;
use App\Models\Influencer;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Log;

class ModalAddInfluencer extends Component
{
    //String
    public $modalType, $modalId, $influencerName = null, $phoneNumber, $countryCode = '62', $instagramLink, $facebookLink, $note;
    //Boolean
    public $isSubmitActivated = false;
    //Object
    public $queryInfluencer;
    //Object
    #[Reactive]
    public $selectedIdInfluencer;

    protected $rules = [
        'phoneNumber' => 'max:12|min:7'
    ];

    protected $messages = [
        'phoneNumber.max' => 'Nomor HP maksimal 12 digit',
        'phoneNumber.min' => 'Nomor HP minimal 7 digit'
    ];

    //LISTENER - Set valu country code
    #[On('set-country-code')]
    public function setCountryCode($phoneCode) {
        $this->countryCode = $phoneCode;
    }

    //HOOK - Execute every time component is rendered
    #[On('event-edit-influencer')]
    public function setValue() {
        if ($this->modalType == 'editInfluencer') {
            $this->queryInfluencer = Influencer::find($this->selectedIdInfluencer);
            $this->isSubmitActivated = true;
            $this->influencerName = $this->queryInfluencer->name;
            $this->phoneNumber = $this->queryInfluencer->phone;
            $this->instagramLink = $this->queryInfluencer->link_instagram;
            $this->facebookLink = $this->queryInfluencer->link_facebook;
            $this->note = $this->queryInfluencer->note;
            $this->countryCode = $this->queryInfluencer->country_code;
        }
    }

    //HOOK - Execute when property is changed
    public function updated($property) {
        $this->isFormFilled();

        if ($property == 'phoneNumber') {
            $this->validateOnly('phoneNumber');
        }
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->influencerName)) {
            return $this->isSubmitActivated = true;
        } else {
            return $this->isSubmitActivated = false;
        }
    }

    //ACTION - Submit form
    public function saveInfluencer() {
        try {
            Influencer::updateOrCreate([
                'id' => $this->queryInfluencer?->id
            ], [
                'name' => $this->influencerName,
                'country_code' => $this->countryCode,
                'phone' => $this->phoneNumber,
                'link_instagram' => $this->instagramLink,
                'link_facebook' => $this->facebookLink,
                'note' => $this->note
            ]
            );
            $this->dispatch('add-influencer-success');
            $this->redirect(route('admin::loyalty.endorse.influencer'), navigate:true);
        } catch (\Throwable $th) {
            Log::error('Gagal menyimpan data influencer:'. $th->getMessage());
            session()->flash('error-add-influencer', 'Terjadi kesalahan saat menyimpan, silahkan coba kembali!');
        }
    }

    public function render()
    {
        return view('livewire.components.modals.admin.royalties.modal-add-influencer');
    }
}
