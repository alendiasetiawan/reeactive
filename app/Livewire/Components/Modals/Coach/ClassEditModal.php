<?php

namespace App\Livewire\Components\Modals\Coach;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class ClassEditModal extends Component
{
    #[Reactive]
    public $classId;
    //String
    public $modalId;
    //Object
    public $classDetail;

    //HOOK - Execute every time component is rendered
    public function boot() {

    }

    public function render()
    {
        return view('livewire.components.modals.coach.class-edit-modal');
    }
}
