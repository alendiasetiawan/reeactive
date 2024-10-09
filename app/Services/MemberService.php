<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function paginateMemberClaimReferral($batchId, $limitData) {
        return Member::queryClaimReferral($batchId)->paginate($limitData);
    }
}
