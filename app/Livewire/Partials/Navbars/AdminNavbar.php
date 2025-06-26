<?php

namespace App\Livewire\Partials\Navbars;

use Livewire\Component;
use App\Traits\NavbarActionTrait;

class AdminNavbar extends Component
{
    use NavbarActionTrait;

    //String
    public $roleName, $firstName, $lastName, $gender;

    public function mount() {
        $accountQuery = $this->getAccountName();
        $this->roleName = $this->getRoleName();
        $this->firstName = $accountQuery['firstName'];
        $this->lastName = $accountQuery['lastName'];
        $this->gender = $accountQuery['gender'];
    }


    public function render()
    {
        return view('livewire.partials.navbars.admin-navbar');
    }
}
