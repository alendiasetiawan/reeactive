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

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    //Scrope to check type of referral
    public function scopeCashback($query, $type) {
        return $query->where('is_cashback', $type);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_code', 'code');
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
                ->join('programs', 'registrations.program_id', 'programs.id')
                ->select('registrations.id', 'registrations.member_code', 'registrations.coach_id', 'coaches.nick_name', 'programs.program_name');
            },
            'batch'
        ])
        ->where('member_code', $memberCode)
        ->where('batch_id', $batchId)
        ->orderBy('id', 'desc')
        ->get();
    }

    //Sum total discount get by user
    public static function sumDiscount($memberCode, $batchId) {
        return ReferralRegistration::where('member_code', $memberCode)
        ->where('batch_id', $batchId)
        ->cashback(false)
        ->sum('discount');
    }

    //Sum total cashback get by user
    public static function sumCashback($memberCode, $batchId) {
        return ReferralRegistration::where('member_code', $memberCode)
        ->where('batch_id', $batchId)
        ->cashback(true)
        ->sum('discount');
    }

    //Get data of registered member using referral code in certain batch
    public static function discountReferrals($memberCode, $batchId) {
        return ReferralRegistration::where('member_code', $memberCode)
        ->where('batch_id', $batchId)
        ->where('is_cashback', 0)
        ->get();
    }

    //Take specific data of one new member registered using referral code
    public static function takeOneMemberReferral($id) {
        return ReferralRegistration::with([
            'registration' => function ($query) {
                $query->join('members', 'registrations.member_code', 'members.code')
                ->join('coaches', 'registrations.coach_id', 'coaches.id')
                ->join('programs', 'registrations.program_id', 'programs.id')
                ->select('registrations.id', 'registrations.member_code', 'registrations.coach_id', 'coaches.nick_name', 'programs.program_name', 'members.member_name');
            }
        ])
        ->join('members', 'referral_registrations.member_code', 'members.code')
        ->select('referral_registrations.*', 'members.member_name')
        ->where('referral_registrations.id', $id)
        ->first();
    }
}
