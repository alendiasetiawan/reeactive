<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function classDates(): HasMany
    {
        return $this->hasMany(ClassDate::class, 'special_registration_id', 'id');
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_code', 'code');
    }

    public function scopeLimitPaymentStatus($query, $type, $limit) {
        return $query->where('payment_status', $type)
        ->orderBy('id', 'desc')
        ->limit($limit);
    }

    //Get the latest special registration data
    public static function latestRegistration($memberCode, $limitData = null) {
        return self::join('programs', 'special_registrations.program_id', '=', 'programs.id')
            ->join('coaches', 'special_registrations.coach_id', '=', 'coaches.id')
            ->join('classes', 'special_registrations.class_id', '=', 'classes.id')
            ->select('special_registrations.*','programs.program_name', 'coaches.nick_name', 'classes.day', 'classes.start_time', 'classes.end_time')
            ->where('special_registrations.member_code', $memberCode)
            ->orderBy('special_registrations.id', 'desc')
            ->limit($limitData)
            ->get();
    }

    //Check is there is any registration besing process
    public static function isRegistrationProcess($memberCode) {
        return self::where('member_code', $memberCode)
        ->where('payment_status', '!=', 'Done')
        ->orderBy('id', 'desc')
        ->limit(1)
        ->exists();
    }

    //Count how many members join the program
    public static function countTotalParticipant($coachId) {
        return self::where('coach_id', $coachId)
        ->where('payment_status', 'Done')
        ->count();
    }

    //Count how many participants who hasn't started their session
    public static function notStartedParticipant($coachId) {
        return self::join('class_dates', 'special_registrations.id', 'class_dates.special_registration_id')
        ->where('coach_id', $coachId)
        ->where('class_dates.date', '>=', date('Y-m-d'))
        ->select('class_dates.special_registration_id')
        ->distinct()
        ->get();
    }

    //Get data all participants of selected coach
    public static function allParticipantsPerCoach($coachId, $limitData, $searchMember = null, $filterData = null) {
        return self::with([
            'classDates',
        ])
        ->join('members', 'special_registrations.member_code', 'members.code')
        ->join('programs', 'special_registrations.program_id', 'programs.id')
        ->join('classes', 'special_registrations.class_id', 'classes.id')
        ->where('coach_id', $coachId)
        ->where('payment_status', 'Done')
        ->when($searchMember, function ($query) use ($searchMember) {
            $query->where('members.member_name', 'like', '%' . $searchMember . '%');
        })
        ->when($filterData['classId'] != 0, function ($query) use ($filterData) {
            $query->where('special_registrations.class_id', $filterData['classId']);
        })
        ->when($filterData['programId'] != 0, function ($query) use ($filterData) {
            $query->where('special_registrations.program_id', $filterData['programId']);
        })
        ->select('special_registrations.*', 'programs.program_name', 'classes.day', 'classes.start_time', 'classes.end_time', 'members.member_name', 'members.mobile_phone', 'members.code')
        ->paginate($limitData);
    }

    //Get latest data of kelas lepasan registrations
    public static function latestRegistrationParticipants($searchMember = null, $transferStatus = null, $limitData = 9) {
        return self::join('members', 'special_registrations.member_code', 'members.code')
        ->join('programs', 'special_registrations.program_id', 'programs.id')
        ->join('coaches', 'special_registrations.coach_id', 'coaches.id')
        ->join('classes', 'special_registrations.class_id', 'classes.id')
        ->with([
            'classDates'
        ])
        ->when($searchMember, function($query) use($searchMember) {
            return $query->where('members.member_name', 'like', '%'.$searchMember.'%');
        })
        ->when($transferStatus, function($query) use($transferStatus) {
            return $query->where('special_registrations.payment_status', $transferStatus);
        })
        ->select('special_registrations.*', 'members.member_name', 'members.mobile_phone', 'programs.program_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time')
        ->orderBy('special_registrations.id', 'desc')
        ->paginate($limitData);
    }

    //Get registration detail
    public static function showRegistrationDetail($id) {
        return self::join('members', 'special_registrations.member_code', 'members.code')
        ->join('programs', 'special_registrations.program_id', 'programs.id')
        ->join('coaches', 'special_registrations.coach_id', 'coaches.id')
        ->join('classes', 'special_registrations.class_id', 'classes.id')
        ->with([
            'classDates'
        ])
        ->where('special_registrations.id', $id)
        ->select('special_registrations.*', 'members.member_name', 'members.mobile_phone', 'programs.program_name', 'coaches.nick_name', 'coaches.coach_name',
        'classes.day', 'classes.start_time', 'classes.end_time')
        ->first();
    }

    //Get participant per class
    public static function queryParticipantPerClass($classId) {
        return self::join('members', 'special_registrations.member_code', 'members.code')
        ->join('classes', 'special_registrations.class_id', 'classes.id')
        ->with([
            'classDates'
        ])
        ->where('special_registrations.class_id', $classId)
        ->select('special_registrations.*', 'members.member_name', 'members.code', 'members.mobile_phone', 'classes.day', 'classes.start_time', 'classes.end_time');
    }
}
