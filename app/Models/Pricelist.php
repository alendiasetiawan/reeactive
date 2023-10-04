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

}
