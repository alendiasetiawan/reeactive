<?php

namespace App\Livewire;

use Exception;
use App\Models\User;
use Livewire\Component;
use App\Models\ResetPassword;
use Livewire\Attributes\Title;
use App\Helpers\EnumValueHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordBaru extends Component
{
    //String
    public $resetCode, $memberName, $program, $newPassword, $retypeNewPassword;
    //Object
    public $member;
    //Boolean
    public $isLinkActive, $isActiveButton, $isPasswordSame, $isShowPassword, $isResetSuccess;

    protected $rules = [
        'newPassword' => 'required|string|min:8',
        'retypeNewPassword' => 'required|string|min:8',
    ];

    protected $messages = [
        'newPassword.required' => 'Password baru harus diisi',
        'newPassword.min' => 'Password minimal 8 karakter',
        'retypeNewPassword.required' => 'Konfirmasi password baru harus diisi',
        'retypeNewPassword.min' => 'Konfirmasi password minimal 8 karakter',
    ];

    #[Title('Buat Password Baru')]

    public function mount($resetCode) {
        $this->resetCode = $resetCode;

        //Check if link is valid
        $this->isLinkActive = ResetPassword::where('reset_code', $this->resetCode)
        ->where('reset_status', EnumValueHelper::RESET_STATUS_OPEN)
        ->exists();

        //Query for get data member
        if ($this->isLinkActive) {
            $this->member = ResetPassword::where('reset_code', $this->resetCode)->firstOrFail();
            $this->memberName = $this->member->member_name;
            $this->program = $this->member->program;
        }

        $this->isActiveButton = $this->isFormFilled();
    }

    public function updated($property) {
        if ($property == 'retypeNewPassword') {
            if ($this->newPassword != $this->retypeNewPassword) {
                $this->isPasswordSame = false;
                $this->isActiveButton = false;
            } else {
                $this->isPasswordSame = true;
                $this->isActiveButton = true;
            }
        }

        if ($property == 'newPassword') {
            $this->reset('retypeNewPassword');
        }

        $this->validate();
    }

    public function isFormFilled() {
        if (empty($this->newPassword) || empty($this->retypeNewPassword)) {
            return false;
        } else {
            return true;
        }
    }

    public function savePassword() {
        //Update password in users table
        DB::beginTransaction();
        try {
            DB::table('users')
            ->where('email', $this->member->member_code)
            ->update([
                'password' => Hash::make($this->retypeNewPassword)
            ]);

            DB::table('reset_password')
            ->where('id', $this->member->id)
            ->update([
                'reset_status' => EnumValueHelper::RESET_STATUS_CLOSE
            ]);

            DB::commit();
            $this->isResetSuccess = true;
            session()->flash('reset-success','Password anda berhasil diubah, silahkan login menggunakan password baru anda!');
        } catch (Exception) {
            DB::rollBack();
            session()->flash('reset-error', 'Terjadi kesalahan, silahkan coba kembali!');
        }
    }

    public function render()
    {
        return view('livewire.password-baru')->layout('layouts.blank');
    }
}
