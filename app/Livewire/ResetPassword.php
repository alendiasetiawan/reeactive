<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use App\Models\PhoneCode;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use App\Helpers\EnumValueHelper;
use Livewire\Attributes\Computed;
use App\Models\ResetPassword as ModelsResetPassword;

class ResetPassword extends Component
{
    #[Layout('layouts.blank')]
    //Integer
    public $phone, $countryPhoneCode = '', $phoneNumber, $findMember;
    //String
    public $mobilePhone = null;
    //Object
    public $phoneCodes;
    //Boolean
    public $showResult = false, $isSendingRequest = false;

    #[Computed]
    public function showMember() {
        return Member::findMember($this->mobilePhone);
    }

    public function rules() {
        return [
            'countryPhoneCode' => 'required',
            'phone' => 'required',
        ];
    }

    public function mount() {
        $this->phoneCodes = PhoneCode::all();
        $this->validate();
    }

    public function updated() {
        $this->validate();
    }

    //Action to check if member exists
    public function checkMember() {
        $this->showResult = true;
        // $isDigitZero = strpos($this->phone, 0);
        // if ($isDigitZero === 0) {
        //     $this->phoneNumber = Str::of($this->phone)->substr(1);
        // } else {
        //     $this->phoneNumber = $this->phone;
        // }

        $this->mobilePhone = $this->countryPhoneCode . $this->phone;

        $this->findMember = Member::where('mobile_phone', $this->mobilePhone)->count();
        if ($this->findMember >= 1) {
            $this->showMember = Member::findMember($this->mobilePhone);
        }
    }

    //Action to send request reset password
    public function resetPassword() {
        $this->isSendingRequest = true;
        $memberName = $this->showMember->member_name;
        $program = $this->showMember->registrations[0]->program?->program_name;
        $coach = ''.$this->showMember->registrations[0]->coach?->coach_name.' ('.$this->showMember->registrations[0]->coach?->nick_name.')';
        $class = ''.$this->showMember->registrations[0]->class_model?->day.' ('.$this->showMember->registrations[0]->class_model?->start_time .' - '.$this->showMember->registrations[0]->class_model?->end_time.')';
        $whatsapp = $this->showMember->mobile_phone;
        $resetCode = time();

        ModelsResetPassword::updateOrCreate([
            'member_code' => $this->showMember->code,
            'reset_status' => EnumValueHelper::RESET_STATUS_OPEN
        ], [
            'member_name' => $memberName,
            'program' => $program,
            'coach' => $coach,
            'class' => $class,
            'whatsapp' => $whatsapp,
            'reset_code' => $resetCode,
            'notif' => 0
        ]);

        $url = "https://api.whatsapp.com/send?phone=628111777021&text=*_LUPA PASSWORD_*%0A%0AHalo admin, saya butuh bantuan untuk reset password dengan data berikut:%0A%0ANama Lengkap: *".$memberName."*%0AProgram: *".$program."*%0ACoach: *".$coach."*%0AKelas: *".$class."*%0A%0A_Terima Kasih_";

        $this->dispatch('sending-request', url:$url);
        session()->flash('reset-sent', 'Aplikasi whatsapp akan terbuka, silahkan kirim pesan yang tertera kepada admin');
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
