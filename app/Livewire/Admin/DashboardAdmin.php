<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\Program;
use Livewire\Component;
use App\Models\Registration;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Charts\MemberInActiveBatchChart;
use App\Charts\RegistrationCategoryChart;
use App\Models\WorkshopBatch;
use App\Models\WorkshopRegistration;

class DashboardAdmin extends Component
{
    #[Layout('layouts.app')]
    #[Title('Dashboard Admin')]

    public $renewalMember;
    public $qtyLastMember;
    public $batchId;
    public $lastBatchId;
    public bool $workshopOpen;
    public object $allWorkshopRegistration;

    protected $memberChart;
    protected $categoryChart;
    protected $batchService;

    public function boot(BatchService $batchService, MemberInActiveBatchChart $memberChart, RegistrationCategoryChart $categoryChart) {
        $batchQuery = $batchService->batchQuery();
        $this->batchId = $batchQuery->id;

        $workshopQuery = $batchService->workshopBatchQuery();
        $workshopBatchId = $workshopQuery->id;
        $batches = Batch::orderBy('id', 'desc')->limit(2)->get();
        $this->lastBatchId = $batches[1]->id;

        $this->memberChart = $memberChart;
        $this->categoryChart = $categoryChart;
        $this->batchService = $batchService;
        $this->renewalMember = Registration::where('batch_id', $this->batchId)->where('registration_category', 'Renewal Member')->count();
        $this->qtyLastMember = Registration::where('batch_id', $this->lastBatchId)->where('payment_status', 'Done')->count();
        $this->workshopOpen = WorkshopBatch::where('batch_status', 'Open')->exists();
        $this->allWorkshopRegistration = WorkshopRegistration::where('workshop_batch_id', $workshopBatchId)->get();

    }

    public function render()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'batch' => Batch::find($this->batchId),
            'memberChart' => $this->memberChart->build($this->batchId),
            'registerCategoryChart' => $this->categoryChart->build($this->batchId),
            'renewalMember' => $this->renewalMember,
            'qtyLastMember' => $this->qtyLastMember,
            'percentRenewalMember' => $this->batchService->renewalMemberPercent($this->renewalMember, $this->qtyLastMember),
            'allRegistrationOpen' => Registration::allRegistrationOpen($this->batchId),
            'membersPerProgram' => Program::membersPerProgram($this->batchId),
        ];

        return view('livewire.admin.dashboard-admin', $data);
    }
}
