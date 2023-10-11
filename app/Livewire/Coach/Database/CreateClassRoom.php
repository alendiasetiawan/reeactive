<?php

namespace App\Livewire\Coach\Database;

use App\Models\ClassModel;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;

class CreateClassRoom extends Component
{
    #[Layout('layouts.app')]
    #[Title('Request Tambah Kelas')]

    #[Locked]
    public $programId;

    public Program $program;
    public $programName;
    public $day;
    public $startTime;
    public $endTime;

    public function mount($id) {
        $this->program = Program::findOrFail($id);
        $this->programName = $this->program->program_name;
        $this->programId = $id;
    }

    public function sendRequest() {
        ClassModel::create([
            'coach_code' => Auth::user()->email,
            'program_id' => $this->programId,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'day' => $this->day,
            'class_status' => 'Pending',
        ]);

        session()->flash('send_request', true);

        $this->redirect(route('coach::class_room'), navigate:true);
    }

    public function render()
    {
        return view('livewire.coach.database.create-class-room');
    }
}
