<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
