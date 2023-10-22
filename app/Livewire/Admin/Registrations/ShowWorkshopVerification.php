<?php

namespace App\Livewire\Admin\Registrations;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use App\Models\WorkshopRegistration;

class ShowWorkshopVerification extends Component
{
    #[Layout('layouts.app')]
    #[Title('Detail Pembayaran Workshop')]

    #[Locked]
    public $registrationId;

    public string $paymentStatus;
    public $invalidReason;
    public bool $showReasonInvalid = FALSE;

    public function mount($id) {
        $this->registrationId = $id;
        $this->paymentStatus = $this->paymentDetail->payment_status;
    }

    #[Computed]
    public function paymentDetail() {
        return WorkshopRegistration::detailWorkshopRegistration($this->registrationId);
    }

    public function updatedPaymentStatus() {
        if ($this->paymentStatus == 'Invalid') {
            $this->showReasonInvalid = true;
        } else {
            $this->showReasonInvalid = false;
        }
    }

    public function saveData() {
        WorkshopRegistration::where('id', $this->registrationId)
        ->update([
            'payment_status' => $this->paymentStatus,
            'invalid_reason' => $this->invalidReason,
        ]);

        session()->flash('paymentSaved', 'Alhamdulillah, verifikasi pembayaran berhasil!');
        $this->redirect(route('admin::workshop_verification'), navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.registrations.show-workshop-verification');
    }
}
