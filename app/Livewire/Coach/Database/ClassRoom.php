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
    #[Title('Member Aktif')]

    public $openForm = false;

    #[Computed]
    public function programs() {
        return Program::classList();
    }

    public function requestClass() {
        $this->openForm = true;
        $this->dispatch('request-form');
    }

    public function closeForm() {
        $this->openForm = false;
    }

    public function render()
    {
        return view('livewire.coach.database.class-room');
    }
}
