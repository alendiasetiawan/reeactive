<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Registration;
use App\Services\BatchService;
use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
    public function index(BatchService $batchService) {

        $batchId = $batchService->batchIdActive();

        $data = [
            'title' => 'Member Dashboard',
            'member' => Registration::infoProgramActive($batchId),
            'registrations' => Registration::personalRegistrationLogs(),
            'batchOpen' => Batch::where('batch_status', 'Open')->count(),
            'checkBatch' => Batch::checkRegisteredBatch(),
        ];

        return view('member.member_dashboard', $data);
    }
}
