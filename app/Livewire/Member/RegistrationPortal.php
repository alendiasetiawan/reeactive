<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class RegistrationPortal extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Portal Pendaftaran')]

    public function render()
    {
        return view('livewire.member.registration-portal');
    }
}
