<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class RegistrationSuccess extends Component
{
    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Berhasil')]

    public $nama;

    public function mount($memberName) {
        $this->nama = $memberName;
    }

    public function render()
    {
        return view('livewire.member.registration-success');
    }
}
