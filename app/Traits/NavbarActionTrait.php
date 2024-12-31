<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait NavbarActionTrait
{
    public function getAccountName() {
        $user = User::where('email', Auth::user()->email)->first();
        $fullname = $user->full_name;
        $name = explode(' ', $fullname);
        $firstName = $name[0];

        if(isset($name[1])) {
            $lastname = $name[1];
        }
        else {
            $lastname = "";
        }

        $gender = $user->gender;

        return [$firstName, $lastname, $gender];
    }

    public function getRoleName() {
        $role = User::join('roles', 'users.role_id','roles.id')
        ->where('users.email', Auth::user()->email)
        ->first();
        $level = $role->role_name;

        return $level;
    }
}
