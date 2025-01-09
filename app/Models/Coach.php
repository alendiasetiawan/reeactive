<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Stmt\Static_;

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
        ->select('id', 'coach_name', 'nick_name', 'color_hex')
        ->where('type', 'Reguler')
        ->orderBy('nick_name', 'asc')
        ->get();
    }

    public static function membersClassPerCoach($batchId, $coachId = null) {
        return Coach::with([
            'classes' => function($query) use($batchId) {
                $query->join('programs', 'classes.program_id', 'programs.id')
                ->select('classes.*', 'programs.program_name', 'program_type')
                ->where('programs.program_type', 'Reguler')
                ->where('classes.class_status', '<>', 'Pending')
                ->with([
                    'registrations' => function($query) use($batchId) {
                        $query->where('batch_id', $batchId);
                    }
                ]);
            }
        ])
        ->where('type', 'Reguler')
        ->when($coachId, function($query) use($coachId) {
            return $query->where('id', $coachId);
        })
        ->orderBy('coach_name', 'asc')
        ->select('id','code', 'coach_name', 'nick_name')
        ->get();
    }

    public static function membersWorkshop($batchId) {
        return Coach::with([
            'classes' => function($query) use($batchId) {
                $query->join('programs', 'classes.program_id', 'programs.id')
                ->where('class_status', '<>', 'Pending')
                ->select('classes.*', 'programs.program_name')
                ->with([
                    'workshop_registrations' => function($query) use($batchId) {
                        $query->where('workshop_batch_id', $batchId);
                    }
                ]);
            }
        ])
        ->where('type', 'Workshop')
        ->orderBy('coach_name', 'asc')
        ->select('code', 'coach_name', 'nick_name')
        ->get();
    }

    //Get all list of reguler coaches
    public static function listRegulerCoaches() {
        return Coach::where('type', 'Reguler')
        ->orderBy('coach_name', 'asc')
        ->get();
    }

    public static function listLepasanClass($coachId = null) {
        return Coach::with([
            'classes' => function($query) {
                $query->join('programs', 'classes.program_id', 'programs.id')
                ->select('classes.*', 'programs.program_name', 'program_type')
                ->where('programs.program_type', 'Special')
                ->where('classes.class_status', '!=', 'Pending')
                ->with([
                    'specialRegistrations'
                ]);
            }
        ])
        ->select('code', 'coach_name', 'nick_name', 'type')
        ->withCount([
            'classes as total_class' => function($query) {
                $query->join('programs', 'classes.program_id', 'programs.id')
                ->where('program_type', 'Special');
            }
        ])
        ->where('type', 'Reguler')
        ->when($coachId, function($query) use($coachId) {
            return $query->where('id', $coachId);
        })
        ->orderByDesc('total_class')
        ->get();
    }
}
