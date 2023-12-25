<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class RegistrationSuccess extends Component
{
    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Berhasil')]

    public ?string $memberName, $programName, $coachFullName, $coachNickName, $classDay, $classStartTime, $classEndTime, $email;

    public function mount($memberName, $programName, $coachFullName, $coachNickName, $classDay, $classStartTime, $classEndTime, $email) {
        $this->memberName = $memberName;
        $this->programName = $programName;
        $this->coachFullName = $coachFullName;
        $this->coachNickName = $coachNickName;
        $this->classDay = $classDay;
        $this->classStartTime = $classStartTime;
        $this->classEndTime = $classEndTime;
        $this->email = $email;
    }

    public function render()
    {
        return view('livewire.member.registration-success');
    }
}
