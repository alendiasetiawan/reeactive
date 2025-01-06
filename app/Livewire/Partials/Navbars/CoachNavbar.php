<?php

namespace App\Livewire\Partials\Navbars;

use Livewire\Component;
use App\Traits\NavbarActionTrait;

class CoachNavbar extends Component
{
    use NavbarActionTrait;

    //String
    public $roleName, $firstName, $lastName, $gender;

    public function mount() {
        $this->roleName = $this->getRoleName();
        $this->firstName = $this->getAccountName()[0];
        $this->lastName = $this->getAccountName()[1];
        $this->gender = $this->getAccountName()[2];
    }

    public function render()
    {
        return view('livewire.partials.navbars.coach-navbar');
    }
}
