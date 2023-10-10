<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function memberActive($batchId) {
        return Registration::join('members', 'registrations.member_code', 'members.code')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('levels', 'registrations.level_id', 'levels.id')
        ->join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->where('registrations.batch_id', $batchId)
        ->where('registrations.payment_status', 'Done')
        ->select('registrations.*', 'members.member_name', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time')
        ->orderBy('members.member_name', 'asc')
        ->get();
    }

    public static function activeMemberPerCoach($batchId, $coachId) {
        return Registration::where('coach_id', $coachId)
        ->where('batch_id', $batchId)
        ->count();
    }

    public static function coachActiveMembers($batchId, $coachId) {
        return Registration::join('members', 'registrations.member_code', 'members.code')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('levels', 'registrations.level_id', 'levels.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->where('registrations.batch_id', $batchId)
        ->where('registrations.coach_id', $coachId)
        ->where('registrations.payment_status', 'Done')
        ->select('registrations.created_at', 'members.member_name', 'members.medical_condition', 'programs.program_name', 'programs.id', 'levels.level_name',
        'classes.day', 'classes.start_time', 'classes.end_time')
        ->orderBy('members.member_name', 'asc')
        ->get();
    }
}
