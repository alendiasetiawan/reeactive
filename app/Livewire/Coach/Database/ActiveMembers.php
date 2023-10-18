<?php

namespace App\Livewire\Coach\Database;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\WithPagination;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class ActiveMembers extends Component
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
    public object $classList;
    public int $filterClass = 0;

    #[Computed]
    public function members() {
        if ($this->filterClass == 0) {
            $members = Member::coachActiveMembers($this->batchId, $this->coachId);
        } else {
            $members = Member::memberInClass($this->batchId, $this->filterClass, $this->coachId);
        }

        return $members;
    }

    public function boot(BatchService $batchService) {
        $batchQuery = $batchService->batchQuery();
        $this->batchId = $batchQuery->id;
        $this->batchName = $batchQuery->batch_name;

        $coach = Coach::where('code', Auth::user()->email)->first();
        $this->coachId = $coach->id;

        $this->activeMember = Member::activeMemberPerCoach($this->batchId, $this->coachId);
        $this->classList = ClassModel::classList();
    }

    public function updated($property) {
        if ($property == 'searchMember') {
            $this->members = Member::coachActiveMembersSearch($this->batchId, $this->coachId, $this->searchMember);
        }

        if ($property == 'filterClass') {
            if ($this->filterClass == 0) {
                $this->members = Member::coachActiveMembers($this->batchId, $this->coachId);
            } else {
                $this->members = Member::memberInClass($this->batchId, $this->filterClass, $this->coachId);
            }
        }
    }

    public function render()
    {
        return view('livewire.coach.database.active-members');
    }
}
