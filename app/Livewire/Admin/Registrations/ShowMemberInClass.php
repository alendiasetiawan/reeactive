<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class ShowMemberInClass extends Component
{
    #[Layout('layouts.app')]
    #[Title('Data Member Per Kelas')]

    public object $members;

    public function mount($classId, $batchId) {
        $this->members = Member::allMemberInClass($classId, $batchId);
    }

    public function render()
    {
        // dd($this->members);
        return view('livewire.admin.registrations.show-member-in-class');
    }
}
