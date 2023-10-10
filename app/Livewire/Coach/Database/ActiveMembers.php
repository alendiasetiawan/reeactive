<?php

namespace App\Livewire\Coach\Database;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class ActiveMembers extends Component
{
    #[Layout('layouts.app')]
    #[Title('Member Aktif')]

    protected $batchService;

    public $members;
    public $batchName;

    public function boot(BatchService $batchService) {
        $batchQuery = $batchService->batchQuery();
        $batchId = $batchQuery->id;
        $this->batchName = $batchQuery->batch_name;

        $coach = Coach::where('code', Auth::user()->email)->first();
        $coachId = $coach->id;

        $this->members = Member::coachActiveMembers($batchId, $coachId);
    }

    public function render()
    {
        return view('livewire.coach.database.active-members');
    }
}
