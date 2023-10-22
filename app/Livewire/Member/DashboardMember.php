<?php

namespace App\Livewire\Member;

use App\Models\User;
use App\Models\Batch;
use App\Models\Member;
use Livewire\Component;
use App\Models\Registration;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\WorkshopRegistration;
use Illuminate\Support\Facades\Auth;

class DashboardMember extends Component
{
    #[Layout('layouts.app')]
    #[Title('Dashboard Member')]

    public object $member;
    public object $registrations;
    public int $batchOpen;
    public object $checkBatch;
    public bool $isRegisteredInWorkshop;
    public object $activeWorkshop;
    public bool $isRegisteredInReeactive;
    public bool $isWorkshopPaymentProcess;
    public object $personalInfo;

    protected $batchService;

    public function mount() {
        $this->isRegisteredInWorkshop = WorkshopRegistration::where('member_code', Auth::user()->email)->exists();
        $this->isRegisteredInReeactive = Registration::where('member_code', Auth::user()->email)->exists();
        $this->personalInfo = Member::where('code', Auth::user()->email)->first();

        if ($this->isRegisteredInWorkshop) {
            $this->activeWorkshop = WorkshopRegistration::activeWorkshop();
            $this->isWorkshopPaymentProcess = WorkshopRegistration::where('member_code', Auth::user()->email)
            ->where('payment_status', 'Process')
            ->exists();
        }

        if ($this->isRegisteredInReeactive) {
            $this->member = Registration::infoProgramActive();
            $this->registrations = Registration::personalRegistrationLogs();
            $this->batchOpen = Batch::where('batch_status', 'Open')->count();
            $this->checkBatch = Batch::checkRegisteredBatch();
        }
    }

    public function confirmDefaultPassword() {
        User::where('email', Auth::user()->email)
        ->update([
            'default_pw' => 0,
        ]);

        $this->redirect(route('member::dashboard'), navigate:true);
    }

    public function render()
    {
        return view('livewire.member.dashboard-member');
    }
}
