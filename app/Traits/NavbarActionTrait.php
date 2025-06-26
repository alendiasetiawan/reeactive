<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait NavbarActionTrait
{
    private $fetchUserRole;

    public function __construct() {
        $this->fetchUserRole = User::join('roles', 'users.role_id','roles.id')
        ->where('users.email', Auth::user()->email)
        ->first();
    }

    public function getAccountName() {
        $fullname = $this->fetchUserRole->full_name;
        $name = explode(' ', $fullname);
        $firstName = $name[0];

        if(isset($name[1])) {
            $lastname = $name[1];
        }
        else {
            $lastname = "";
        }

        $gender = $this->fetchUserRole->gender;

        return [
            'firstName' => $firstName,
            'lastName' => $lastname,
            'gender' => $gender
        ];
    }

    public function getRoleName() {
        $level = $this->fetchUserRole->role_name;

        return $level;
    }
}
