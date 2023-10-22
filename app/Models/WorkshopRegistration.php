<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkshopRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
}
