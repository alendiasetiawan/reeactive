<?php

namespace App\Livewire\Coach\Database;

use App\Models\Program;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Auth;

class CreateClassRoom extends Component
{
    //Object
    public $listPrograms;
    //Integer
    public $selectedProgram = "";
    //String
    public $day, $startTime, $endTime, $linkWa;
    //Boolean
    public $isSubmitActive;

    #[Reactive]
    public $idModal;

    public function mount($idModal) {
        $this->idModal = $idModal;
        $this->listPrograms = Program::where('program_type', 'Reguler')->get();
    }

    //Check if all fields are filled
    public function isFormFilled() {
        if(!empty($this->selectedProgram) && !empty($this->day) && !empty($this->startTime) && !empty($this->endTime) && !empty($this->linkWa)) {
            $this->isSubmitActive = "1";
        } else {
            $this->isSubmitActive = "0";
        }
    }

    public function updated() {
        $this->isFormFilled();
    }

    public function sendRequest() {
        // ClassModel::create([
        //     'coach_code' => Auth::user()->email,
        //     'program_id' => $this->programId,
        //     'start_time' => $this->startTime,
        //     'end_time' => $this->endTime,
        //     'day' => $this->day,
        //     'class_status' => 'Pending',
        // ]);

        $this->dispatch('request-sent');

        // $this->redirect(route('coach::class_room'), navigate:true);
    }

    public function render()
    {
        return view('livewire.coach.database.create-class-room');
    }
}
