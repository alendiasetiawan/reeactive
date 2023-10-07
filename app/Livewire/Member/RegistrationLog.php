<?php

namespace App\Livewire\Member;

use Livewire\Component;
use App\Models\Registration;

class RegistrationLog extends Component
{
    public $registrationLogs;


    public function mount() {
        $this->registrationLogs = Registration::personalRegistrationLogs();
    }

    public function render()
    {
        return view('livewire.member.registration-log');
    }
}
