<?php

namespace App\Livewire\Registrations;

use Livewire\Component;
use Livewire\Attributes\Title;

class LandingProgram extends Component
{
    #[Title('Program Pilihan')]

    public function render()
    {
        return view('livewire.registrations.landing-program')->layout('layouts.vuexy-blank');
    }
}
