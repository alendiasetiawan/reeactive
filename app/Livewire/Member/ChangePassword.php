<?php

namespace App\Livewire\Member;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    #[Layout('layouts.app')]
    #[Title('Ganti Password Akun')]

    #[Rule([
        'newPassword' => 'required|min:5',
    ], message: [
        'newPassword.required' => 'Anda belum menuliskan password baru',
        'newPassword.min' => 'Password minimal 6 digit',
    ])]
    public $newPassword;

    #[Rule([
        'retypeNewPassword' => 'required',
    ], message: [
        'retypeNewPassword.required' => 'Tolong tulis ulang pasword baru anda',
    ])]
    public $retypeNewPassword;

    public $passNotSame;

    public function updated($property) {
        if ($property == 'retypeNewPassword') {
            if($this->newPassword != $this->retypeNewPassword) {
                $this->passNotSame = true;
            } else {
                $this->passNotSame = false;
            }
        }
    }

    public function savePassword() {
        $this->validate();

        User::where('email', Auth::user()->email)
        ->update([
            'password' => Hash::make($this->newPassword),
            'default_pw' => 0,
        ]);

        session()->flash('password-changed', true);
        $this->redirect(route('ganti_password'), navigate:true);
    }

    public function render()
    {
        return view('livewire.member.change-password');
    }
}
