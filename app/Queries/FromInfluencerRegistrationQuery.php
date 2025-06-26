<?php

namespace App\Queries;

use App\Models\FromInfluencerRegistration;

class FromInfluencerRegistrationQuery {

    public static function fetchDetailRegistration($registrationId) {
        return FromInfluencerRegistration::join('influencer_referrals', 'from_influencer_registrations.influencer_referral_id', 'influencer_referrals.id')
        ->select('from_influencer_registrations.*', 'influencer_referrals.discount', 'influencer_referrals.used_limit', 'influencer_referrals.expired_date')
        ->where('from_influencer_registrations.registration_id', $registrationId)
        ->first();
    }
}