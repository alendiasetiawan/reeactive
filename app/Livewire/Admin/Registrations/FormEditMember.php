<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Coach;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\Attributes\Computed;

class FormEditMember extends Component
{
    public int $selectedLevel;
    public string $selectedCoach = '';
    public int $selectedClass;
    public int $coachCode = 0;

    public function updated($property, $value) {
        if ($property == 'selectedCoach') {
            $coach = Coach::find($value);
            $this->coachCode = $coach->code;
        }
    }

    #[Computed]
    public function coaches() {
        return Coach::where('coach_status', 'Aktif')->pluck('nick_name', 'id');
    }

    #[Computed]
    public function classes() {
        return ClassModel::where('coach_code', $this->coachCode)->where('class_status', '<>', 'Pending')->get();
    }

    public function render()
    {
        return view('livewire.admin.registrations.form-edit-member');
    }
}
