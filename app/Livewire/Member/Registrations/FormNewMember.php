<?php

namespace App\Livewire\Member\Registrations;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class FormNewMember extends Component
{
    #[Layout('layouts.blank')]
    #[Title('Form Pendaftaran Member Baru')]

    public function render()
    {
        return view('livewire.member.registrations.form-new-member');
    }
}
