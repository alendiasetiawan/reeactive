<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricelist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class, 'coach_code', 'code');
    }

    public function coach_skills(): HasMany
    {
        return $this->hasMany(CoachSkill::class, 'coach_code', 'coach_code');
    }

    public function coach_certificates(): HasMany
    {
        return $this->hasMany(CoachCertificate::class, 'coach_code', 'coach_code');
    }

    public static function showCoachBasedOnProgram($programId) {
        return Pricelist::join('coaches', 'pricelists.coach_code', 'coaches.code')
        ->where('pricelists.program_id', $programId)
        ->where('coaches.coach_status', 'Aktif')
        ->orderBy('coaches.coach_name', 'asc')
        ->get();
    }

    public static function showActiveCoachEksternal($programId) {
        return Pricelist::join('coaches', 'pricelists.coach_code', 'coaches.code')
        ->where('pricelists.program_id', $programId)
        ->where('coaches.coach_status_eksternal', 'Aktif')
        ->orderBy('coaches.coach_name', 'asc')
        ->get();
    }

}
