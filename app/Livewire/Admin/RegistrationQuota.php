<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class RegistrationQuota extends Component
{
    #[Layout('layouts.app')]
    #[Title('Kuota Pendaftaran')]

    public function mount() {

    }

    public function render()
    {
        return view('livewire.admin.registration-quota');
    }
}
