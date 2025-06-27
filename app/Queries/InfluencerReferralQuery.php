<?php

namespace App\Queries;

use App\Models\InfluencerReferral;

class InfluencerReferralQuery
{
    public static function paginateReferralCodes($limitData, $influencerId = null) {
        return InfluencerReferral::baseQuery(
            influencerId: $influencerId
        )
        ->join('influencers', 'influencer_referrals.influencer_id', 'influencers.id')
        ->select('influencer_referrals.*', 'influencers.name as influencer_name')
        ->withCount('fromInfluencerRegistrations as total_referral_registered')
        ->latest()
        ->paginate($limitData);
    }
}