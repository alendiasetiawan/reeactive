<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkshopRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_code', 'code');
    }

    public static function activeWorkshop() {
        return WorkshopRegistration::join('programs', 'workshop_registrations.program_id', 'programs.id')
        ->join('coaches', 'workshop_registrations.coach_id', 'coaches.id')
        ->join('classes', 'workshop_registrations.class_id', 'classes.id')
        ->where('member_code', Auth::user()->email)
        ->select('workshop_registrations.*', 'programs.program_name', 'coaches.nick_name', 'classes.day', 'classes.link_wa')
        ->orderBy('workshop_registrations.id', 'desc')
        ->limit(1)
        ->first();
    }

    public static function allWorkshopRegistrations($workshopBatchId) {
        return WorkshopRegistration::join('members', 'workshop_registrations.member_code', 'members.code')
        ->join('programs', 'workshop_registrations.program_id', 'programs.id')
        ->join('coaches', 'workshop_registrations.coach_id', 'coaches.id')
        ->join('classes', 'workshop_registrations.class_id', 'classes.id')
        ->where('workshop_registrations.workshop_batch_id', $workshopBatchId)
        ->select('workshop_registrations.*', 'members.member_name', 'members.mobile_phone', 'programs.program_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time')
        ->orderBy('workshop_registrations.id', 'desc')
        ->get();
    }

    public static function detailWorkshopRegistration($id) {
        return WorkshopRegistration::join('members', 'workshop_registrations.member_code', 'members.code')
        ->join('programs', 'workshop_registrations.program_id', 'programs.id')
        ->join('coaches', 'workshop_registrations.coach_id', 'coaches.id')
        ->join('classes', 'workshop_registrations.class_id', 'classes.id')
        ->where('workshop_registrations.id', $id)
        ->select('workshop_registrations.*', 'members.member_name', 'programs.program_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time', 'classes.link_wa')
        ->first();
    }
}
