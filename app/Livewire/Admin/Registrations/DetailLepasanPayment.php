<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\SpecialRegistration;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class DetailLepasanPayment extends Component
{
    #[Title('Detail Transfer Kelas Lepasan')]
    #[Layout('layouts.vuexy-app')]

    public $paymentStatus;
    public $showReasonInvalid;
    public $paymentId;
    public $invalidReason;
    public $discEarlyBird, $amountDisc;
    public $firstBatchName, $discountType;
    //String
    public $registrationType;
    //Boolean
    public $isDiscountApply, $isRegisteredViaReferral;
    //Object
    public $batch;

    protected $rules = [
        'invalidReason' => 'required'
    ];

    protected $messages = [
        'invalidReason.required' => 'Tolong isi alasan invalidnya ya!',
    ];

    #[Computed]
    public function paymentDetail() {
        return SpecialRegistration::showRegistrationDetail($this->paymentId);
    }

    public function mount($id) {
        $this->paymentId = $id;
        $this->paymentStatus = $this->paymentDetail->payment_status;
        $this->invalidReason = $this->paymentDetail->invalid_reason;

        if ($this->paymentStatus == 'Invalid') {
            $this->showReasonInvalid = true;
        } else {
            $this->showReasonInvalid = false;
        }
    }

    public function updated($property, $value) {
        if ($property == 'paymentStatus') {
            if ($value == 'Invalid') {
                $this->showReasonInvalid = true;
                $this->validateOnly('invalidReason');
            } else {
                $this->showReasonInvalid = false;
                $this->resetValidation('invalidReason');
            }
        }

        if ($property == 'invalidReason') {
            $this->validateOnly('invalidReason');
        }
    }

    public function saveData() {
        SpecialRegistration::where('id', $this->paymentId)
        ->update([
            'payment_status' => $this->paymentStatus,
            'invalid_reason' => $this->invalidReason,
        ]);

        $this->dispatch('payment-verification-success');
        $this->redirect(route('admin::lepasan_payment_verification'), navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.registrations.detail-lepasan-payment');
    }
}
