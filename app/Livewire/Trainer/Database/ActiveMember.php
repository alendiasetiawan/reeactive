<?php

namespace App\Livewire\Trainer\Database;

use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Models\ClassModel;
use App\Models\Program;
use App\Models\WorkshopRegistration;
use Livewire\WithPagination;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class ActiveMember extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    #[Title('Member Aktif')]

    protected $batchService;

    public string $batchName;
    public int $batchId;
    public int $coachId;
    public string $searchMember;
    public int $activeMember;
    public int $activeMemberInProgram;
    public object $programList;
    public int $filterProgram = 0;

    #[Computed]
    public function members() {
        return WorkshopRegistration::activeParticipantPerCoach($this->batchId, $this->coachId);
    }

    public function boot(BatchService $batchService) {
        $batchQuery = $batchService->workshopBatchQuery();
        $this->batchId = $batchQuery->id;

        $coach = Coach::where('code', Auth::user()->email)->first();
        $this->coachId = $coach->id;

        $this->activeMember = WorkshopRegistration::activeParticipant($this->coachId, $this->batchId);
        $this->programList = Program::where('program_type', 'Workshop')->get();
    }

    public function updated($property) {
        if ($property == 'searchMember') {
            $this->resetPage();
            $this->members = WorkshopRegistration::activeParticipantPerCoachSearch($this->batchId, $this->coachId, $this->searchMember);
        }

        if ($property == 'filterProgram') {
            $this->resetPage();
            if ($this->filterProgram == 0) {
                $this->members = WorkshopRegistration::activeParticipantPerCoach($this->batchId, $this->coachId);
            } else {
                $this->members = WorkshopRegistration::memberInProgram($this->batchId, $this->coachId, $this->filterProgram);
                $this->activeMemberInProgram = WorkshopRegistration::activeParticipantInProgram($this->batchId, $this->coachId, $this->filterProgram);
            }
        }
    }
    public function render()
    {
        return view('livewire.trainer.database.active-member');
    }
}
