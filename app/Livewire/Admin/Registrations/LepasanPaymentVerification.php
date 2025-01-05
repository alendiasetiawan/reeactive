<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Batch;
use Livewire\Component;
use Detection\MobileDetect;
use App\Models\Registration;
use App\Models\SpecialRegistration;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class LepasanPaymentVerification extends Component
{
    #[Title('Verifikasi Transfer Kelas Lepasan')]
    #[Layout('layouts.vuexy-app')]

    //Integer
    public $batchId, $totalPaymentDone, $totalPaymentProcess, $totalPaymentInvalid, $limitData = 9;
    //String
    public $batchName, $searchMember = '', $transferStatus;
    //Boolean
    public $isTablet;

    protected $batchService;

    #[Computed]
    public function payments() {
        return SpecialRegistration::latestRegistrationParticipants($this->searchMember, $this->transferStatus, $this->limitData);
    }

    public function boot(MobileDetect $mobileDetect) {
        $mobileDetect->isTablet() ? $this->isTablet = true : $this->isTablet = false;
        $this->totalPaymentProcess = SpecialRegistration::limitPaymentStatus('Process', 30)->count();
        $this->totalPaymentInvalid = SpecialRegistration::limitPaymentStatus('Invalid', 30)->count();
    }

    public function loadMore() {
        $this->limitData += 18;
    }

    public function render()
    {
        return view('livewire.admin.registrations.lepasan-payment-verification');
    }
}
