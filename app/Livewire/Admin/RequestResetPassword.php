<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ResetPassword;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class RequestResetPassword extends Component
{
    //Integer
    public $limitData = 9, $tambahData = 9;
    //String
    public $searchMember = null;

    #[Title('Request Reset Password')]
    #[Layout('layouts.vuexy-app')]

    #[Computed]
    public function requestMembers() {
        return ResetPassword::newestRequest($this->limitData, $this->searchMember);
    }

    public function sendLink($id) {
        $member = ResetPassword::find($id);
        $link = 'https://apps.reeactive.com/link-reset/'.$member->reset_code;

        $url = "https://api.whatsapp.com/send?phone=".$member->whatsapp."&text=*_KONFIRMASI RESET PASSWORD_*%0A%0AUntuk melakukan reset password pada data di bawah ini:%0A%0ANama Lengkap: *".$member->member_name."*%0AProgram: *".$member->program."*%0ACoach: *".$member->coach."*%0AKelas: *".$member->class."*%0A%0Asilahkan klik link berikut: ".$link."%0A%0A_Admin Reeactive_";

        $member->update([
            'notif' => 1
        ]);
        $this->dispatch('sending-link', url: $url);
    }

    public function loadMore() {
        $this->limitData += $this->tambahData;
    }

    public function render()
    {
        // return view('livewire.admin.request-reset-password');
        return view('livewire.admin.vuexy-request-reset-password');
    }
}
