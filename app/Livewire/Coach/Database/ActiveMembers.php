<?php

namespace App\Livewire\Coach\Database;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class ActiveMembers extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    #[Title('Member Aktif')]

    protected $batchService;

    public $batchName;
    public $batchId;
    public $coachId;
    public $searchMember;

    public function boot(BatchService $batchService) {
        $batchQuery = $batchService->batchQuery();
        $this->batchId = $batchQuery->id;
        $this->batchName = $batchQuery->batch_name;

        $coach = Coach::where('code', Auth::user()->email)->first();
        $this->coachId = $coach->id;
    }

    public function updated($property) {
        if ($property == 'searchMember') {
            $this->members = Member::coachActiveMembersSearch($this->batchId, $this->coachId, $this->searchMember);
            $this->resetPage();
        }
    }

    public function getMembersProperty() {
        $members = Member::coachActiveMembers($this->batchId, $this->coachId);

        return $members;
    }

    public function render()
    {
        $data = [
            'members' => $this->members,
        ];

        return view('livewire.coach.database.active-members', $data);
    }
}
