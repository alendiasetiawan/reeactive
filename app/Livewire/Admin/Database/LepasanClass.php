<?php

namespace App\Livewire\Admin\Database;

use App\Models\Coach;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class LepasanClass extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Kuota Pendaftaran')]

    public object $registeredMember;
    public $selectedBatch, $selectedCoach = '';
    public string $searchMember = '';
    //Object
    public $lastBatches, $regulerCoaches;
    //Boolean
    public $isResetFilter = false;

    //HOOK - Execute once when component is rendered
    public function mount() {
        $this->regulerCoaches = Coach::listRegulerCoaches();
    }

    #[Computed]
    public function membersPerCoach() {
        return Coach::listLepasanClass($this->selectedCoach);
    }

    public function render()
    {
        return view('livewire.admin.database.lepasan-class');
    }
}
