<?php

namespace App\Livewire\Admin;

use App\Models\Member;
use App\Models\ReferralRegistration;
use Livewire\Component;
use App\Models\Registration;
use App\Services\BatchService;
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
    public $discEarlyBird, $amountDisc;
    public $firstBatchName, $discountType;
    //String
    public $registrationType;
    //Boolean
    public $isDiscountApply;
    //Object
    public $batch;

    public function mount($id) {
        $batchService = new BatchService;
        $this->batch = $batchService->batchQuery();
        $this->paymentDetail = Registration::showRegistrationDetail($id);
        $this->paymentId = $id;
        $this->discEarlyBird = $this->paymentDetail->disc_early_bird;
        $registration = Registration::firstBatchRegistered($this->paymentDetail->member_code);
        $this->firstBatchName = $registration->batch_name;
        $registrationType = $this->paymentDetail->registration_type;
        $memberCode = $this->paymentDetail->member_code;
        $batchId = $this->batch->id;

        $referralMembers = ReferralRegistration::discountReferrals($memberCode, $batchId);

        if ($registrationType == 'Early Bird') {
            $this->discountType = 'Early Bird';
            $this->isDiscountApply = true;
            $this->amountDisc = $this->discEarlyBird;
        } else {
            if ($referralMembers->count() > 0) {
                $this->discountType = 'Referral';
                $this->isDiscountApply = true;
                $this->amountDisc = $referralMembers->sum('discount');
            } else {
                $this->isDiscountApply = false;
            }
        }
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
