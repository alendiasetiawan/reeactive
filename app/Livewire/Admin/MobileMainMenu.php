<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Title;

class MobileMainMenu extends Component
{
    #[Title('Mobile Main Menu')]

    public function render()
    {
        return view('livewire.admin.mobile-main-menu')->layout('layouts.app');
    }
}
