<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $guarded = [];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'class_id', 'id');
    }

    public function workshop_registrations(): HasMany
    {
        return $this->hasMany(WorkshopRegistration::class, 'class_id', 'id');
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class, 'coach_code', 'code');
    }

    public static function memberPerCoach($batchId, $coachId) {
        return ClassModel::with([
            'registrations' => function ($query) use($batchId, $coachId) {
                $query->where('batch_id', $batchId)
                ->where('coach_id', $coachId)
                ->where('payment_status', 'Done');
            }
        ])
        ->join('programs', 'classes.program_id', 'programs.id')
        ->select('classes.*', 'programs.program_name', 'programs.quota_max')
        ->where('coach_code', Auth::user()->email)
        ->orderBy('start_time', 'asc')
        ->get();
    }

    public static function showActiveClassExternal($programId, $coachCode) {
        return ClassModel::where('coach_code', $coachCode)
        ->where('class_status_eksternal','Open')
        ->where('program_id', $programId)
        ->get();
    }

    public static function classList() {
        return ClassModel::where('coach_code', Auth::user()->email)
        ->orderBy('start_time', 'asc')
        ->get();
    }
}
