<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
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

    public static function personalRegistrationLogs() {
        return Registration::join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('batches', 'registrations.batch_id', 'batches.id')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->where('member_code', Auth::user()->email)
        ->select('registrations.*', 'coaches.nick_name', 'batches.batch_name', 'programs.program_name')
        ->orderBy('registrations.id', 'desc')
        ->get();
    }

    public static function lastRegistrationData() {
        return Registration::where('member_code', Auth::user()->email)
        ->latest()
        ->first();
    }

    public static function infoProgramActive($batchId) {
        return Registration::join('batches', 'registrations.batch_id', 'batches.id')
        ->join('programs', 'registrations.program_id', 'programs.id')
        ->join('levels', 'registrations.level_id', 'levels.id')
        ->join('coaches', 'registrations.coach_id', 'coaches.id')
        ->join('classes', 'registrations.class_id', 'classes.id')
        ->where('registrations.batch_id', $batchId)
        ->where('member_code', Auth::user()->email)
        ->select('registrations.*', 'batches.batch_name', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time', 'classes.link_wa')
        ->orderBy('registrations.id', 'desc')
        ->limit(1)
        ->first();
    }

}
