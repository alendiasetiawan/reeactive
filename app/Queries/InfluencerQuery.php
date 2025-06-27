<?php

namespace App\Queries;

use App\Models\Influencer;
use App\Services\BatchService;

class InfluencerQuery {

    public static function paginateListInfluencers($limitData) {
        return Influencer::baseQuery()
            ->activeInfluencer()
            ->with(['influencerReferrals' => function($query) {
            $query->select('influencer_id', 'code', 'is_active', 'expired_date')
                ->withCount('fromInfluencerRegistrations as total_referral_registered' );
            }])
            ->withCount('influencerReferrals as total_referral_code')
            ->withCount('fromInfluencerRegistrations as total_member_registered')
        ->paginate($limitData);
    }

    public static function listActiveInfluencers() {
        return Influencer::activeInfluencer()
        ->select('id', 'name')
        ->orderBy('name', 'asc')
        ->get();
    }

}