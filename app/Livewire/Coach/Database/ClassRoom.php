<?php

namespace App\Livewire\Coach\Database;

use App\Models\Program;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClassRoom extends Component
{
    //Object
    public $listPrograms;
    //Integer
    public $selectedProgram = null, $classId;
    //String
    public $day, $startTime, $endTime, $linkWa, $decryptId, $programName;
    //Boolean
    public $isSubmitActive = false, $isClassFound = false;

    #[Layout('layouts.app')]
    #[Title('Daftar Kelas Coach')]

    #[Computed]
    public function programs() {
        return Program::classList();
    }

    public function mount() {
        $this->listPrograms = Program::where('program_type', 'Reguler')->get();
    }

    //Check if all fields are filled
    public function isFormFilled() {
        if(!empty($this->selectedProgram) && !empty($this->day) && !empty($this->startTime) && !empty($this->endTime) && !empty($this->linkWa)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    public function updated() {
        $this->isFormFilled();
    }

    public function setValueClass($id) {
        $this->decryptId = Crypt::decrypt($id);
        $checkClass = ClassModel::where('id', $this->decryptId)->exists();

        if($checkClass) {
            $this->isClassFound = true;
            $class = ClassModel::with('program')
            ->where('id', $this->decryptId)
            ->firstOrFail();

            $this->classId = $class->id;
            $this->programName = $class->program->program_name;
            $this->day = $class->day;
            $this->startTime = $class->start_time;
            $this->endTime = $class->end_time;
            $this->linkWa = $class->link_wa;
        } else {
            $this->isClassFound = false;
        }
    }

    //Reset all property before add new class
    public function addClass() {
        $this->reset(['isClassFound', 'selectedProgram', 'programName', 'day', 'startTime', 'endTime', 'linkWa']);
    }

    //Add new class
    public function sendRequest() {
        ClassModel::create([
            'coach_code' => Auth::user()->email,
            'program_id' => $this->selectedProgram,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'day' => $this->day,
            'link_wa' => $this->linkWa,
            'class_status' => 'Pending',
        ]);

        $this->dispatch('request-sent');
    }

    //Edit class
    public function editClass() {
        ClassModel::where('id', $this->classId)->update([
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'day' => $this->day,
            'link_wa' => $this->linkWa,
            'class_status' => 'Pending',
        ]);

        $this->dispatch('class-updated');
    }


    public function render()
    {
        return view('livewire.coach.database.class-room');
    }
}
