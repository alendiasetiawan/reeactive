<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferralRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id', 'id');
    }

    //Count data of registered member using referral code in certain batch
    public static function countRegisteredMember($memberCode, $batchId) {
        return ReferralRegistration::where('member_code', $memberCode)->where('batch_id', $batchId)->count();
    }

    //Get data of registered member using referral code in certain batch
    public static function getReferralMember($memberCode, $batchId) {
        return ReferralRegistration::with([
            'registration' => function ($query) {
                $query->with('member')
                ->join('coaches', 'registrations.coach_id', 'coaches.id')
                ->select('registrations.id', 'registrations.member_code', 'registrations.coach_id');
            }
        ])
        ->where('member_code', $memberCode)
        ->where('batch_id', $batchId)
        ->get();
    }
}
