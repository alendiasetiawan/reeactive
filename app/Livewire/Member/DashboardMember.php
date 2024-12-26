<?php

namespace App\Livewire\Member;

use App\Models\User;
use App\Models\Batch;
use App\Models\Member;
use Livewire\Component;
use App\Models\Registration;
use App\Models\SpecialRegistration;
use App\Models\VoucherMerchandise;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\WorkshopRegistration;
use App\Services\BatchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class DashboardMember extends Component
{
    #[Layout('layouts.app')]
    #[Title('Dashboard Member')]

    public object $member;
    public object $registrations, $latestSpecialRegistration;
    public int $batchOpen, $specialRegistrationId, $registrationId;
    public object $checkBatch;
    public bool $isRegisteredInWorkshop;
    public object $activeWorkshop;
    public bool $isRegisteredInReeactive;
    public bool $isWorkshopPaymentProcess, $isSpecialRegistration;
    //Object
    public $personalInfo, $lastVoucherMerchandise, $batchQuery;
    //String
    public $linkVoucher, $modalInvalidType;
    //Boolean
    public $isVoucherExist;

    protected $batchService;

    public function mount(BatchService $batchService) {
        $this->batchQuery = $batchService->batchQuery();
        $this->isRegisteredInWorkshop = WorkshopRegistration::where('member_code', Auth::user()->email)->exists();
        $this->isRegisteredInReeactive = Registration::where('member_code', Auth::user()->email)->exists();
        $this->isSpecialRegistration = SpecialRegistration::where('member_code', Auth::user()->email)->exists();
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

            $this->isVoucherExist = VoucherMerchandise::where('member_code', Auth::user()->email)
            ->where('batch_id', $this->batchQuery->id)
            ->exists();

            if ($this->isVoucherExist) {
                $this->lastVoucherMerchandise = VoucherMerchandise::latestVoucher(Auth::user()->email, $this->member->batch_id);
                $this->linkVoucher = url('validasi-voucher-merchandise/'.$this->lastVoucherMerchandise->qr_code);
            }
        }

        if ($this->isSpecialRegistration) {
            $this->latestSpecialRegistration = SpecialRegistration::latestRegistration(Auth::user()->email);
            $this->specialRegistrationId = $this->latestSpecialRegistration->id;
        }
    }

    public function confirmDefaultPassword() {
        User::where('email', Auth::user()->email)
        ->update([
            'default_pw' => 0,
        ]);

        $this->redirect(route('member::dashboard'), navigate:true);
    }

    //ONCLICK - Set modal invalid type
    public function invalidRegulerProgram() {
        $this->modalInvalidType = 'Reguler Program';
        $this->registrationId = $this->member->id;
    }

    //ONCLICK - Set modal invalid type
    public function invalidSpecialProgram() {
        $this->modalInvalidType = 'Special Program';
        $this->registrationId = $this->specialRegistrationId;
    }

    public function render()
    {
        return view('livewire.member.dashboard-member');
    }
}
