<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Get the latest special registration data
    public static function latestRegistration($memberCode, $limitData = null) {
        return self::join('programs', 'special_registrations.program_id', '=', 'programs.id')
            ->join('coaches', 'special_registrations.coach_id', '=', 'coaches.id')
            ->join('classes', 'special_registrations.class_id', '=', 'classes.id')
            ->select('special_registrations.*','programs.program_name', 'coaches.nick_name', 'classes.day', 'classes.start_time', 'classes.end_time')
            ->where('special_registrations.member_code', $memberCode)
            ->orderBy('special_registrations.id', 'desc')
            ->limit($limitData)
            ->get();
    }

    //Check is there is any registration besing process
    public static function isRegistrationProcess($memberCode) {
        return self::where('member_code', $memberCode)
        ->where('payment_status', '!=', 'Done')
        ->orderBy('id', 'desc')
        ->limit(1)
        ->exists();
    }
}
