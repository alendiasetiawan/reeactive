<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pricelists(): HasMany
    {
        return $this->hasMany(Pricelist::class, 'program_id', 'id');
    }

    public static function allProgramPricelists() {
        return Program::with([
            'pricelists' => function ($query) {
                $query->join('coachs', 'pricelists.coach_code', 'coachs.code')
                ->join('coach_skills', 'pricelists.coach_code', 'coach_skills.coach_code')
                ->join('coach_certificates', 'pricelists.coach_code', 'coach_certificates.coach_code')
                ->select('coachs.*', 'coach_skills.skill_name', 'coach_certificates.certificate_name', 'pricelists.program_id', 'pricelists.coach_code',
                'pricelists.price', 'pricelists.price_per_person')
                ->get();
            }
        ])
        ->get();
    }

    public static function privatePrograms() {
        return Pricelist::with([
            'coach_skills',
        ])
        ->join('coachs', 'pricelists.coach_code', 'coachs.code')
        ->where('program_id', 1)
        ->orderBy('pricelists.id', 'asc')
        ->get();
    }

    public static function buddyPrograms() {
        return Pricelist::with([
            'coach_skills',
        ])
        ->join('coachs', 'pricelists.coach_code', 'coachs.code')
        ->where('program_id', 2)
        ->orderBy('pricelists.id', 'asc')
        ->get();
    }

    public static function smallPrograms() {
        return Pricelist::with([
            'coach_skills',
        ])
        ->join('coachs', 'pricelists.coach_code', 'coachs.code')
        ->where('program_id', 3)
        ->orderBy('pricelists.id', 'desc')
        ->get();
    }

    public static function specialPrograms() {
        return Pricelist::with([
            'coach_skills',
        ])
        ->join('coachs', 'pricelists.coach_code', 'coachs.code')
        ->where('program_id', 4)
        ->orderBy('pricelists.id', 'asc')
        ->get();
    }

    public static function largePrograms() {
        return Pricelist::with([
            'coach_skills',
        ])
        ->join('coachs', 'pricelists.coach_code', 'coachs.code')
        ->where('program_id', 5)
        ->orderBy('pricelists.id', 'desc')
        ->get();
    }

    public static function nutrionPrograms() {
        return Pricelist::with([
            'coach_skills',
        ])
        ->join('coachs', 'pricelists.coach_code', 'coachs.code')
        ->where('program_id', 6)
        ->orderBy('pricelists.id', 'asc')
        ->get();
    }
}
