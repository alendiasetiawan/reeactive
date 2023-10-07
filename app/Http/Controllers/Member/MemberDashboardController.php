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

        $batchId = $batchService->batchId();

        $data = [
            'title' => 'Member Dashboard',
            'infoProgram' => Registration::infoProgramActive($batchId),
        ];

        return view('member.member_dashboard', $data);
    }
}
