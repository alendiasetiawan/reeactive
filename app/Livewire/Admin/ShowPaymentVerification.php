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
    #[Layout('layouts.vuexy-app')]
    #[Title('Detail Pembayaran Member Reguler')]

    public $paymentDetail;
    public $paymentStatus;
    public $showReasonInvalid;
    public $paymentId;
    public $invalidReason;
    public $discEarlyBird, $amountDisc;
    public $firstBatchName, $discountType;
    //String
    public $registrationType, $note;
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
        $this->paymentStatus = $this->paymentDetail->payment_status;
        $this->invalidReason = $this->paymentDetail->invalid_reason;
        $this->note = $this->paymentDetail->note;

        $referralMembers = ReferralRegistration::discountReferrals($memberCode, $batchId);

        //Check if member registered using referral code
        $this->isRegisteredViaReferral = ReferralRegistration::where('registration_id', $id)->count() > 0 ? true : false;

        if ($registrationType == 'Early Bird') {
            $this->discountType = 'Early Bird';
            $this->isDiscountApply = true;
            $this->amountDisc = $this->discEarlyBird;
        } else {
            if ($referralMembers->count() > 0 || $this->isRegisteredViaReferral) {
                $this->discountType = 'Referral';
                $this->isDiscountApply = true;

                if ($referralMembers->count() > 0) {
                    $this->amountDisc = $referralMembers->sum('discount');
                } else {
                    $this->amountDisc = $this->batch->discount_referral;
                }
            } else {
                $this->isDiscountApply = false;
            }
        }

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
            $this->paymentDetail = Registration::showRegistrationDetail($this->paymentId);
        }

        if ($property == 'invalidReason') {
            $this->validateOnly('invalidReason');
        }
    }

    public function saveData() {
        Registration::where('id', $this->paymentId)
        ->update([
            'payment_status' => $this->paymentStatus,
            'invalid_reason' => $this->invalidReason,
            'note' => $this->note
        ]);

        $this->dispatch('payment-verification-success');
        $this->redirect(route('admin::payment_verification'), navigate:true);
    }

    public function render()
    {
        // return view('livewire.admin.show-payment-verification');
        return view('livewire.admin.vuexy-show-payment-verification');
    }
}
