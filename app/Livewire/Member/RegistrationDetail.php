<?php

namespace App\Livewire\Member;

use Livewire\Component;

class RegistrationDetail extends Component
{
    public $detail;

    public function render()
    {
        return view('livewire.member.registration-detail');
    }
}
