<?php

namespace App\Livewire\Coach;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Models\ClassModel;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class DashboardCoach extends Component
{
    #[Layout('layouts.app')]
    #[Title('Dashboard Coach')]

    protected $batchService;

    public $membersInClass;
    public $batchId;
    public $batchName;
    public $activeMember;

    public function boot(BatchService $batchService) {

        $coach = Coach::where('code', Auth::user()->email)->first();
        $coachId = $coach->id;

        $this->batchId = $batchService->batchIdActive();
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;

        $this->membersInClass = ClassModel::memberPerCoach($this->batchId, $coachId);
        $this->activeMember = Member::activeMemberPerCoach($this->batchId, $coachId);
    }

    public function render()
    {
        return view('livewire.coach.dashboard-coach');
    }
}
