<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class RenewalRegistration extends Component
{
    #[Layout('layouts.app')]
    #[Title('Renewal Registration')]


    public function render()
    {
        return view('livewire.member.renewal-registration');
    }
}
