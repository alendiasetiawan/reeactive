<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Registration;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class ShowPaymentVerification extends Component
{
    #[Layout('layouts.app')]
    #[Title('Detail Pembayaran Member')]

    public $paymentDetail;
    public $paymentStatus;
    public $showReasonInvalid;
    public $paymentId;
    public $invalidReason;

    public function mount($id) {
        $this->paymentDetail = Registration::showRegistrationDetail($id);
        $this->paymentId = $id;
    }

    public function updated($property, $value) {
        if ($property == 'paymentStatus') {
            if ($value == 'Invalid') {
                $this->showReasonInvalid = true;
            } else {
                $this->showReasonInvalid = false;
            }
            $this->paymentDetail = Registration::showRegistrationDetail($this->paymentId);
        }
    }

    public function saveData() {
        Registration::where('id', $this->paymentId)
        ->update([
            'payment_status' => $this->paymentStatus,
            'invalid_reason' => $this->invalidReason,
        ]);

        session()->flash('paymentSaved', 'Alhamdulillah, verifikasi pembayaran berhasil!');
        $this->redirect(route('admin::payment_verification'), navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.show-payment-verification');
    }
}
