<?php

namespace App\Livewire\Components\Modals\Admin\Royalties;

use Livewire\Component;
use App\Models\Influencer;
use Illuminate\Support\Facades\Log;

class ModalAddInfluencer extends Component
{
    //String
    public $modalId, $influencerName, $phoneNumber, $countryCode = '62', $instagramLink, $facebookLink, $note;
    //Boolean
    public $isSubmitActivated = false;

    protected $rules = [
        'phoneNumber' => 'max:12|min:7'
    ];

    protected $messages = [
        'phoneNumber.max' => 'Nomor HP maksimal 12 digit',
        'phoneNumber.min' => 'Nomor HP minimal 7 digit'
    ];

    //HOOK - Execute once when component is rendered
    public function mount($modalId) {
        $this->modalId = $modalId;
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
        if (!empty($this->influencerName) && !empty($this->phoneNumber)) {
            $this->isSubmitActivated = true;
        } else {
            $this->isSubmitActivated = false;
        }
    }

    //ACTION - Submit form
    public function saveInfluencer() {
        try {
            Influencer::create([
                'name' => $this->influencerName,
                'country_code' => $this->countryCode,
                'phone' => $this->phoneNumber,
                'link_instagram' => $this->instagramLink,
                'link_facebook' => $this->facebookLink,
                'note' => $this->note
            ]);

            $this->dispatch('add-influencer-success');
            $this->redirect(route('admin::influencer'), navigate:true);
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
