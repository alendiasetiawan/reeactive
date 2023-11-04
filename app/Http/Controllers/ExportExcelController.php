<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Coach;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Services\BatchService;
use App\Exports\AllMembersExport;
use App\Exports\MemberPerClassExport;
use App\Exports\MemberPerCoachExport;

class ExportExcelController extends Controller
{
    public function allMember($batchId, Excel $excel) {
        $batch = Batch::find($batchId);

        return $excel->download(New AllMembersExport($batchId),'('.$batch->batch_name.') Database Member Reeactive.xlsx');
    }

    public function perCoach($coachId, Excel $excel, BatchService $batchService) {
        $coach = Coach::find($coachId);
        $batchQuery = $batchService->batchQuery();
        $batchId = $batchQuery->id;
        $batchName = $batchQuery->batch_name;

        return $excel->download(New MemberPerCoachExport($coachId, $batchId),'(Coach '.$coach->nick_name.' - '.$batchName.') Database Member Reeactive.xlsx');
    }

    public function perClass(Request $request, Excel $excel, BatchService $batchService) {
        $coachId = $request->coach_id;
        $classId = $request->class_id;
        $coach = Coach::find($coachId);
        $batchQuery = $batchService->batchQuery();
        $batchId = $batchQuery->id;
        $batchName = $batchQuery->batch_name;

        return $excel->download(New MemberPerClassExport($coachId, $classId, $batchId),'(Coach '.$coach->nick_name.' - '.$batchName.') Database Member Reeactive Per Jadwal.xlsx');
    }
}
