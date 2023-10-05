<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class MemberDashboard extends Component
{
    #[Layout('layouts.app')]
    #[Title('Member Dashboard')]

    public function render()
    {
        return view('livewire.member.member-dashboard');
    }
}
