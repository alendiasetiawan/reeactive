<?php

namespace App\Livewire\Member;

use App\Models\User;
use App\Models\Batch;
use Livewire\Component;
use App\Models\Registration;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class DashboardMember extends Component
{
    #[Layout('layouts.app')]
    #[Title('Dashboard Member')]

    public $batchId;
    public $member;
    public $registrations;
    public $batchOpen;
    public $checkBatch;

    protected $batchService;

    public function boot(BatchService $batchService) {
        $batchId = $batchService->batchIdActive();
        $this->member = Registration::infoProgramActive($batchId);
        $this->registrations = Registration::personalRegistrationLogs();
        $this->batchOpen = Batch::where('batch_status', 'Open')->count();
        $this->checkBatch = Batch::checkRegisteredBatch();
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
