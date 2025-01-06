<?php

namespace App\Models;

use App\Helpers\EnumValueHelper;
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

    public function specialRegistrations(): HasMany
    {
        return $this->hasMany(SpecialRegistration::class, 'class_id', 'id');
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
        ->where('programs.program_type', '!=', 'Special')
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
        return ClassModel::join('programs', 'classes.program_id', 'programs.id')
        ->select('classes.*', 'programs.program_name', 'programs.quota_max')
        ->where('coach_code', Auth::user()->email)
        ->where('programs.program_type', '!=', 'Special')
        ->orderBy('start_time', 'asc')
        ->get();
    }

    public static function classByFilter($filter) {
        return ClassModel::with([
            'program',
            'coach'
        ])
        ->when(isset($filter['status']), function ($query) use ($filter) {
            $query->where('class_status', $filter['status'])
            ->orWhere('class_status_eksternal', $filter['status']);
        })
        ->when(isset($filter['programId']), function ($query) use ($filter) {
            $query->where('program_id', $filter['programId']);
        })
        ->when(isset($filter['coachCode']), function ($query) use ($filter) {
            $query->where('coach_code', $filter['coachCode']);
        });
    }

    //Get data member in Kelas Lepasan
    public static function memberPerCoachLepasan($coachId) {
        return ClassModel::with([
            'specialRegistrations' => function ($query) use($coachId) {
                $query->where('coach_id', $coachId)
                ->where('payment_status', 'Done');
            }
        ])
        ->join('programs', 'classes.program_id', 'programs.id')
        ->select('classes.*', 'programs.program_name', 'programs.quota_max')
        ->where('coach_code', Auth::user()->email)
        ->where('programs.program_type', 'Special')
        ->orderBy('start_time', 'asc')
        ->get();
    }

    //Get data class list of selected coach
    public static function classListByCoach($coachCode) {
        return ClassModel::where('coach_code', $coachCode)
        ->where('program_id', EnumValueHelper::ID_LARGE_GROUP)
        ->orderBy('start_time', 'asc')
        ->get();
    }

    //Get list of class in Kelas Lepasan for every coach
    public static function classListLepasan($coachCode) {
        return self::join('programs', 'classes.program_id', 'programs.id')
        ->where('coach_code', $coachCode)
        ->where('programs.program_type', 'Special')
        ->select('classes.*', 'programs.program_name', 'programs.program_type')
        ->orderBy('start_time', 'asc')
        ->get();
    }

    //Check if the coach have kelas lepasan
    public static function checkCoachLepasan($coachCode) {
        return self::join('programs', 'classes.program_id', 'programs.id')
        ->where('programs.program_type', 'Special')
        ->where('coach_code', $coachCode)
        ->exists();
    }

    //Get data member for selected class of coach
    public static function memberPerClass($classId) {
        return self::join('programs', 'classes.program_id', 'programs.id')
        ->join('coaches', 'classes.coach_code', 'coaches.code')
        ->select('classes.*', 'programs.program_name', 'coaches.coach_name', 'coaches.nick_name')
        ->where('classes.id', $classId)
        ->first();
    }

    //Total reguler class
    public static function totalRegulerClass() {
        return self::join('programs', 'classes.program_id', 'programs.id')
        ->where('programs.program_type', 'Reguler')
        ->count();
    }

    //Total lepasan class
    public static function totalLepasanClass() {
        return self::join('programs', 'classes.program_id', 'programs.id')
        ->where('programs.program_type', 'Special')
        ->count();
    }
}
