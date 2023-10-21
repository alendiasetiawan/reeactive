<?php

namespace App\Services;

use App\Models\Program;
use App\Models\Registration;
use App\Models\WorkshopRegistration;

class RegistrationService {

    public function quotaLeft($programId, $levelId, $coachId, $classId, $batchId) {
        //Check number of member registered
        $registeredMember = Registration::where('program_id', $programId)
        ->where('coach_id', $coachId)
        ->where('class_id', $classId)
        ->where('batch_id', $batchId)
        ->count();

        //Check program's quota
        if ($levelId != 3) {
            $program = Program::find($programId);
            $quotaProgram = $program->quota_max;
        } else {
            $quotaProgram = 17;
        }

        $quotaLeft = $quotaProgram - $registeredMember;

        return $quotaLeft;
    }

    public function quotaWorkshop($programId, $coachId) {
        //Check number of participants registered
        $registeredMember = WorkshopRegistration::where('program_id', $programId)
        ->where('coach_id', $coachId)
        ->count();

        //Check program's quota
        $program = Program::find($programId);
        $quotaProgram = $program->quota_max;

        $quotaLeft = $quotaProgram - $registeredMember;

        return $quotaLeft;
    }

}
