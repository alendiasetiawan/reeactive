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

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
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

    public static function activeParticipant($coachId, $batchId) {
        return WorkshopRegistration::where('coach_id', $coachId)
        ->where('workshop_batch_id', $batchId)
        ->where('payment_status', 'Done')
        ->count();
    }

    public static function activeParticipantInProgram($batchId, $coachId, $programId) {
        return WorkshopRegistration::where('coach_id', $coachId)
        ->where('workshop_batch_id', $batchId)
        ->where('program_id', $programId)
        ->where('payment_status', 'Done')
        ->count();
    }

    public static function activeParticipantPerCoach($batchId, $coachId) {
        return WorkshopRegistration::join('members', 'workshop_registrations.member_code', 'members.code')
        ->join('programs', 'workshop_registrations.program_id', 'programs.id')
        ->join('classes', 'workshop_registrations.class_id', 'classes.id')
        ->where('workshop_registrations.workshop_batch_id', $batchId)
        ->where('workshop_registrations.coach_id', $coachId)
        ->where('workshop_registrations.payment_status', 'Done')
        ->select('workshop_registrations.created_at', 'members.member_name','members.mobile_phone', 'members.medical_condition', 'programs.program_name', 'programs.id',
        'classes.day', 'classes.start_time', 'classes.end_time', 'workshop_registrations.is_assessment', 'workshop_registrations.voucher_code')
        ->orderBy('members.member_name', 'asc')
        ->paginate(9);
    }

    public static function activeParticipantPerCoachSearch($batchId, $coachId, $searchMember) {
        return WorkshopRegistration::join('members', 'workshop_registrations.member_code', 'members.code')
        ->join('programs', 'workshop_registrations.program_id', 'programs.id')
        ->join('classes', 'workshop_registrations.class_id', 'classes.id')
        ->where('workshop_registrations.workshop_batch_id', $batchId)
        ->where('workshop_registrations.coach_id', $coachId)
        ->where('workshop_registrations.payment_status', 'Done')
        ->where('members.member_name', 'like', '%'.$searchMember.'%')
        ->select('workshop_registrations.created_at', 'members.member_name','members.mobile_phone', 'members.medical_condition', 'programs.program_name', 'programs.id',
        'classes.day', 'classes.start_time', 'classes.end_time', 'workshop_registrations.is_assessment', 'workshop_registrations.voucher_code')
        ->orderBy('members.member_name', 'asc')
        ->paginate(9);
    }

    public static function memberInProgram($batchId, $coachId, $programId) {
        return WorkshopRegistration::join('members', 'workshop_registrations.member_code', 'members.code')
        ->join('programs', 'workshop_registrations.program_id', 'programs.id')
        ->join('classes', 'workshop_registrations.class_id', 'classes.id')
        ->where('workshop_registrations.workshop_batch_id', $batchId)
        ->where('workshop_registrations.coach_id', $coachId)
        ->where('workshop_registrations.program_id', $programId)
        ->where('workshop_registrations.payment_status', 'Done')
        ->select('workshop_registrations.id', 'workshop_registrations.created_at', 'workshop_registrations.registration_category', 'members.member_name', 'members.medical_condition', 'programs.program_name',
        'classes.day', 'classes.start_time', 'classes.end_time', 'members.mobile_phone')
        ->orderBy('members.member_name', 'asc')
        ->paginate(9);
    }
}
