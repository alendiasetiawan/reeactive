<?php

namespace App\Services;

use App\Models\SpecialRegistration;

class SpecialRegistrationService {

    public function paginateParticipantInClass($classId, $limitData, $searchMember = null) {
        return SpecialRegistration::queryParticipantPerClass($classId)
        ->when($searchMember, function($query) use($searchMember) {
            return $query->where('members.member_name', 'like', '%'.$searchMember.'%');
        })
        ->paginate($limitData);
    }

    public function totalParticipantInClass($classId) {
        return SpecialRegistration::queryParticipantPerClass($classId)
        ->count();
    }
}
