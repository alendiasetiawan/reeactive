<?php

namespace App\Livewire\Loyalties;

use Detection\MobileDetect;
use Livewire\Component;
use Livewire\Attributes\Title;

class Influencer extends Component
{
    public $nama;
    public $isMobile;

    #[Title('Database Influencer')]

    public function mount() {
        $this->nama = 'Alendia Desta';
    }

    public function boot(MobileDetect $mobileDetect) {
        $this->isMobile = $mobileDetect->isMobile();
    }

    public function render()
    {
        return view('livewire.loyalties.influencer')->layout('layouts.vuexy-app');
    }
}
