<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

class PrivacyPolicy extends Component
{
    #[Title('Privacy Policy')]

    public function render()
    {
        return view('livewire.privacy-policy')->layout('layouts.blank');
    }
}
