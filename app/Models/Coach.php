<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coach extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pricelists(): HasMany
    {
        return $this->hasMany(Pricelist::class, 'coach_code', 'code');
    }

    public function coach_skills(): HasMany
    {
        return $this->hasMany(CoachSkill::class, 'coach_code', 'code');
    }

    public function coach_certificates(): HasMany
    {
        return $this->hasMany(CoachCertificate::class, 'coach_code', 'code');
    }

    public static function coachPricing() {
        return Coach::with([
            'pricelists' => function ($query) {
                $query->where('program_id', 1);
            },
            'coach_skills',
            'coach_certificates',
        ])
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->get();
    }
}
