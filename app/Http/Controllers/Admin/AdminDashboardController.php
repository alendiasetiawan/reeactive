<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Registration;
use App\Services\BatchService;
use App\Http\Controllers\Controller;
use App\Charts\MemberInActiveBatchChart;
use App\Charts\RegistrationCategoryChart;
use App\Models\Program;

class AdminDashboardController extends Controller
{
    public function index(BatchService $batchService, MemberInActiveBatchChart $memberChart, RegistrationCategoryChart $categoryChart) {

        $batchId = $batchService->batchIdActive();
        $batches = Batch::orderBy('id', 'desc')->limit(2)->get();
        $lastBatchId = $batches[1]->id;

        $renewalMember = Registration::where('batch_id', $batchId)->where('registration_category', 'Renewal Member')->count();
        $qtyLastMember = Registration::where('batch_id', $lastBatchId)->where('payment_status', 'Done')->count();

        $data = [
            'title' => 'Admin Dashboard',
            'batch' => Batch::find($batchId),
            'memberChart' => $memberChart->build($batchId),
            'registerCategoryChart' => $categoryChart->build($batchId),
            'renewalMember' => $renewalMember,
            'qtyLastMember' => $qtyLastMember,
            'percentRenewalMember' => $batchService->renewalMemberPercent($renewalMember, $qtyLastMember),
            'allRegistrationOpen' => Registration::allRegistrationOpen($batchId),
            'membersPerProgram' => Program::membersPerProgram($batchId),
        ];

        return view('admin.admin_dashboard', $data);
    }
}
