<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function paginateMemberClaimReferral($batchId, $limitData, $searchMember = null) {
        return Member::queryClaimReferral($batchId, $searchMember)->paginate($limitData);
    }
}
