<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Referral;
use App\Models\ReferralRegistration;
use App\Services\BatchService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GenerateReferralCode extends Component
{
    //Boolean
    public $isCodeGenerated;
    //String
    public $memberCode;
    //Object
    public $referral, $registeredByReferral;
    //Integer
    public $batchId;

    protected BatchService $batchService;

    //HOOK - Execute once when component is rendered
    public function mount(BatchService $batchService) {
        //Assign initial value for conditional query
        $this->batchId = $batchService->batchIdActive();
        $this->memberCode = Auth::user()->email;

        $this->isCodeGenerated = Referral::where('member_code', $this->memberCode)->exists();
        $this->referral = Referral::where('member_code', $this->memberCode)->first();
        $this->registeredByReferral = ReferralRegistration::countRegisteredMember($this->memberCode, $this->batchId);
    }

    //ONCLICK - Generate Referral Code
    /**Create referral code when user doesn't have it*/
    public function generateCode() {
        $randomString = Str::upper(Str::random(4));
        //Count how many referral codes already exist
        $countReferral = Referral::count();
        $addDigit = $countReferral + 1;
        $code = ''.$randomString.''.$addDigit.'';

        Referral::create([
            'member_code' => $this->memberCode,
            'code' => $code
        ]);

        $this->redirect(route('member::dashboard'), navigate:true);
    }

    public function render()
    {
        return view('livewire.components.generate-referral-code');
    }
}
