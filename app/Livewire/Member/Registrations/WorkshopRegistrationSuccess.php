<?php

namespace App\Livewire\Member\Registrations;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class WorkshopRegistrationSuccess extends Component
{
    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Workshop Berhasil')]

    public $nama;

    public function mount($memberName) {
        $this->nama = $memberName;
    }

    public function render()
    {
        return view('livewire.member.registrations.workshop-registration-success');
    }
}
