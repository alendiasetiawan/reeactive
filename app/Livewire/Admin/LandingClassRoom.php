<?php

namespace App\Livewire\Admin;

use App\Models\ClassModel;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class LandingClassRoom extends Component
{
    #[Title('Portal Manajemen Kelas')]
    #[Layout('layouts.vuexy-app')]

    //Integer
    public $totalRegulerClass, $totalLepasanClass;

    public function mount() {
        $this->totalRegulerClass = ClassModel::totalRegulerClass();
        $this->totalLepasanClass = ClassModel::totalLepasanClass();
    }

    public function render()
    {
        return view('livewire.admin.landing-class-room');
    }
}
