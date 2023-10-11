<?php

namespace App\Livewire\Coach\Database;

use Livewire\Component;
use App\Models\ClassModel;
use App\Models\Program;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class ClassRoom extends Component
{
    #[Layout('layouts.app')]
    #[Title('Daftar Kelas Coach')]

    #[Computed]
    public function programs() {
        return Program::classList();
    }

    public function render()
    {
        return view('livewire.coach.database.class-room');
    }
}
