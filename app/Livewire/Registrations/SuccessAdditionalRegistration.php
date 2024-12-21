<?php

namespace App\Livewire\Registrations;

use Carbon\Carbon;
use Livewire\Component;
use App\Helpers\TanggalHelper;
use Livewire\Attributes\Title;

class SuccessAdditionalRegistration extends Component
{
    #[Title('Pendaftaran Kelas Lepas Berhasil')]

    //String
    public $memberName, $coachFullName, $coachNickName, $programName, $classDay, $startTime, $endTime;

    //HOOK - Execute once when component is rendered
    public function mount($memberName, $coachFullName, $coachNickName, $programName, $classDay, $classStartTime, $classEndTime) {
        $this->memberName = $memberName;
        $this->coachFullName = $coachFullName;
        $this->coachNickName = $coachNickName;
        $this->programName = $programName;
        $this->classDay = TanggalHelper::convertImplodeDay($classDay);
        $this->startTime = Carbon::parse($classStartTime)->format('H:i');
        $this->endTime = Carbon::parse($classEndTime)->format('H:i');
    }

    public function render()
    {
        return view('livewire.registrations.success-additional-registration')->layout('layouts.vuexy-blank');
    }
}
