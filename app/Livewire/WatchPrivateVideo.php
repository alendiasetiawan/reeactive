<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class WatchPrivateVideo extends Component
{
    #[Layout('layouts.blank')]
    #[Title('Tonton Video Private Workshop')]

    public $activationCode = 'PVWorkshop2023';
    public $isCodeValid = false;
    public $inputCode;

    public function updatedInputCode() {
        if ($this->inputCode == $this->activationCode) {
            $this->isCodeValid = true;
        } else {
            $this->isCodeValid = false;
        }
    }

    public function render()
    {
        return view('livewire.watch-private-video');
    }
}
