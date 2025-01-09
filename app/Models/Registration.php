<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function class_model(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_code', 'code');
    }

    public function referralRegistration(): HasOne
    {
        return $this->hasOne(ReferralRegistration::class, 'registration_id', 'id');
    }

    public function voucherMerchandise(): HasOne
    {
        return $this->hasOne(VoucherMerchandise::class, 'registration_id', 'id');
    }

    public static function personalRegistrationLogs() {
        return Registration::join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('batches', 'registrations.batch_id', 'batches.id')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->where('member_code', Auth::user()->email)
        ->select('registrations.*', 'coaches.nick_name', 'batches.batch_name', 'programs.program_name')
        ->limit(5)
        ->orderBy('registrations.id', 'desc')
        ->get();
    }

    public static function lastRegistrationData() {
        return Registration::where('member_code', Auth::user()->email)
        ->latest()
        ->first();
    }

    public static function infoProgramActive() {
        return Registration::join('batches', 'registrations.batch_id', 'batches.id')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('levels', 'registrations.level_id', 'levels.id')
        ->join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->where('member_code', Auth::user()->email)
        ->select('registrations.*', 'batches.batch_name', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time', 'classes.link_wa')
        ->orderBy('registrations.id', 'desc')
        ->limit(1)
        ->first();
    }

    public static function showRegistrationDetail($id) {
        return Registration::join('members', 'registrations.member_code', 'members.code')
        ->join('batches', 'registrations.batch_id', 'batches.id')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('levels', 'registrations.level_id', 'levels.id')
        ->join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->where('registrations.id', $id)
        ->select('registrations.*', 'members.member_name', 'batches.batch_name', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time', 'classes.link_wa', 'disc_early_bird')
        ->first();
    }

    public static function allRegistrationOpen($batchId, $searchMember = null, $transferStatus = null, $limitData = 9) {
        return Registration::join('members', 'registrations.member_code', 'members.code')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('levels', 'registrations.level_id', 'levels.id')
        ->join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->where('registrations.batch_id', $batchId)
        ->when($searchMember, function($query) use($searchMember) {
            return $query->where('members.member_name', 'like', '%'.$searchMember.'%');
        })
        ->when($transferStatus, function($query) use($transferStatus) {
            return $query->where('registrations.payment_status', $transferStatus);
        })
        ->select('registrations.*', 'members.member_name', 'members.mobile_phone', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time')
        ->orderBy('registrations.id', 'desc')
        ->paginate($limitData);
    }

    //Find first batch registered
    public static function firstBatchRegistered($memberCode) {
        return Registration::join('batches', 'registrations.batch_id', 'batches.id')
        ->where('member_code', $memberCode)
        ->select('batches.*', 'registrations.member_code')
        ->orderBy('id', 'asc')
        ->limit(1)
        ->first();
    }

    //Get limit latest registration data for admin
    public static function limitLatestRegistration($batchId, $limitData) {
        return Registration::join('members', 'registrations.member_code', 'members.code')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->select('registrations.*', 'members.member_name', 'programs.program_name', 'coaches.nick_name', 'coaches.coach_name', 'classes.day', 'classes.start_time', 'classes.end_time', 'classes.link_wa')
        ->where('batch_id', $batchId)
        ->orderBy('registrations.id', 'desc')
        ->limit($limitData)
        ->get();
    }

    //How many member who is waiting for payment verification
    public static function waitingVerification($batchId) {
        return self::where('batch_id', $batchId)
        ->where (function ($query) {
            $query->where('payment_status', 'Invalid')
            ->orWhere('payment_status', 'Process');
        })
        ->count();
    }

    //Sum total income reguler program
    public static function totalReguler($batchId) {
        return self::where('batch_id', $batchId)
        ->where (function ($query) {
            $query->where('payment_status', 'Done')
            ->orWhere('payment_status', 'Follow Up');
        });
    }
}
