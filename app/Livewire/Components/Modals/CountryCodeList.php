<?php

namespace App\Livewire\Components\Modals;

use Livewire\Component;
use App\Models\PhoneCode;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class CountryCodeList extends Component
{
    //String
    public $modalId, $search = '';
    //Collection
    public $countryCodeLists = [];

    //LISTENER - Execute when user want to see country code lists
    #[On('open-country-code-list')]
    public function getData() {
        $this->getCountryCode();
    }

    //HOOK - Execute when property is changed
    public function updated($property) {
        if ($property == 'search') {
            $this->getCountryCode();
        }
    }

    //ACTION - Set country code to modal
    public function setCountryCode($code) {
        $this->dispatch('set-country-code', phoneCode: $code);
        $this->reset('search');
    }

    //ACTION - Query to ge country code lists
    public function getCountryCode() {
        $this->countryCodeLists = PhoneCode::baseQuery($this->search);
    }

    public function render()
    {
        return view('livewire.components.modals.country-code-list');
    }
}
