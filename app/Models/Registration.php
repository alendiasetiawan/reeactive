<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function personalRegistrationLogs() {
        return Registration::join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('batches', 'registrations.batch_id', 'batches.id')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->where('member_code', Auth::user()->email)
        ->select('registrations.*', 'coaches.nick_name', 'batches.batch_name', 'programs.program_name')
        ->orderBy('registrations.id', 'desc')
        ->get();
    }
}
