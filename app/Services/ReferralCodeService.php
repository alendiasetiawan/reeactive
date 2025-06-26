<?php

namespace App\Services;

use App\Models\Referral;
use App\Models\InfluencerReferral;

class ReferralCodeService {

    public function generateReferralCode($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function checkIfReferralCodeExists($code) {
        $referral = Referral::where('code', $code)->count();
        $influencerReferral = InfluencerReferral::where('code', $code)->count();
        if ($referral > 0 || $influencerReferral > 0) {
            return true;
        } else {
            return false;
        }
    }
}