<?php

namespace App\Livewire\Admin\Database;

use App\Models\Coach;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\Attributes\Computed;

class FilterCoachClass extends Component
{
    public $selectedCoach = '';
    public $selectedClass = '';
    public $isDisabledButton = true;

    public function updatedSelectedCoach() {
        $this->reset('selectedClass');
    }

    #[Computed]
    public function coaches() {
        return Coach::where('type', 'Reguler')
        ->where(function($query) {
            $query->orWhere('coach_status', 'Aktif')
            ->orWhere('coach_status_eksternal', 'Aktif');
        })
        ->orderBy('nick_name', 'asc')
        ->get();
    }

    #[Computed]
    public function classes() {
        $coach = Coach::find($this->selectedCoach);
        $coachCode = $coach->code;

        return ClassModel::where('coach_code', $coachCode)->get();
    }

    public function render()
    {
        return view('livewire.admin.database.filter-coach-class');
    }
}
