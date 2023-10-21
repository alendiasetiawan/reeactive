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

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'coach_id', 'id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class, 'coach_code', 'code');
    }




    public static function privatePricing() {
        return Coach::with([
            'coach_skills',
            'coach_certificates',
        ])
        ->join('pricelists', 'coaches.code', 'pricelists.coach_code')
        ->where('program_id', 1)
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->get();
    }

    public static function buddyPricing() {
        return Coach::with([
            'coach_skills',
            'coach_certificates',
        ])
        ->join('pricelists', 'coaches.code', 'pricelists.coach_code')
        ->where('program_id', 2)
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->get();
    }

    public static function smallPricing() {
        return Coach::with([
            'coach_skills',
            'coach_certificates',
        ])
        ->join('pricelists', 'coaches.code', 'pricelists.coach_code')
        ->where('program_id', 3)
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->get();
    }

    public static function specialCasePricing() {
        return Coach::with([
            'coach_skills',
            'coach_certificates',
        ])
        ->join('pricelists', 'coaches.code', 'pricelists.coach_code')
        ->where('program_id', 4)
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->get();
    }
    public static function largePricing() {
        return Coach::with([
            'coach_skills',
            'coach_certificates',
        ])
        ->join('pricelists', 'coaches.code', 'pricelists.coach_code')
        ->where('program_id', 5)
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->get();
    }

    public static function memperPerCoach($batchId) {
        return Coach::with([
            'registrations' => function ($query) use($batchId) {
                $query->where('batch_id', $batchId);
            }
        ])
        ->select('id', 'coach_name', 'nick_name')
        ->orderBy('coach_name', 'asc')
        ->get();
    }

    public static function membersClassPerCoach($batchId) {
        return Coach::with([
            'classes' => function($query) use($batchId) {
                $query->where('class_status', '<>', 'Pending')
                ->with([
                    'registrations' => function($query) use($batchId) {
                        $query->where('batch_id', $batchId);
                    }
                ]);
                // ->select('classes.coach_code', 'classes.program_id', 'classes.start_time', 'classes.end_time', 'classes.day', 'classes.class_status', 'classes.class_status_eksternal', 'registrations.*');
            }
        ])
        ->where('coach_status', 'Aktif')
        ->orderBy('coach_name', 'asc')
        ->select('code', 'coach_name', 'nick_name')
        ->get();
    }
}
