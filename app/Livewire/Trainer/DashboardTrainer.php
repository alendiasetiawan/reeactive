<?php

namespace App\Livewire\Trainer;

use App\Models\Coach;
use App\Models\Program;
use App\Models\WorkshopRegistration;
use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class DashboardTrainer extends Component
{
    #[Layout('layouts.app')]
    #[Title('Dashboard Trainer')]

    public $members;
    public $activeParticipants;

    public function mount(BatchService $batchService) {
        $batchQuery = $batchService->workshopBatchQuery();
        $batchId = $batchQuery->id;

        $coach = Coach::where('code', Auth::user()->email)->first();
        $coachId = $coach->id;

        $this->members = Program::participantsPerProgram($batchId, $coachId);
        $this->activeParticipants = WorkshopRegistration::activeParticipant($coachId, $batchId);

        // dd($this->members);
    }

    public function render()
    {
        return view('livewire.trainer.dashboard-trainer');
    }
}
