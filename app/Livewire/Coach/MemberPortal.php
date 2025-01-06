<?php

namespace App\Livewire\Coach;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class MemberPortal extends Component
{
    #[Title('Portal Database Member')]
    #[Layout('layouts.vuexy-app')]

    public function render()
    {
        return view('livewire.coach.member-portal');
    }
}
