<?php

namespace App\Livewire\Coach\Database;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\WithPagination;
use App\Services\BatchService;
use Detection\MobileDetect;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class ActiveMembers extends Component
{
    use WithPagination;

    #[Layout('layouts.vuexy-app')]
    #[Title('Member Aktif')]

    protected $batchService;

    public string $batchName;
    public int $batchId;
    public int $coachId;
    public string $searchMember;
    public int $activeMember;
    public int $activeMemberInClass;
    public object $classList;
    public int $filterClass = 0, $limitData = 9;
    //Boolean
    public $isMobile, $isTablet;

    #[Computed]
    public function members() {
        return Member::coachActiveMembers($this->batchId, $this->coachId, $this->limitData);
    }

    public function boot(BatchService $batchService, MobileDetect $mobileDetect) {
        $batchQuery = $batchService->batchQuery();
        $this->batchId = $batchQuery->id;
        $this->batchName = $batchQuery->batch_name;

        $coach = Coach::where('code', Auth::user()->email)->first();
        $this->coachId = $coach->id;

        $this->activeMember = Member::activeMemberPerCoach($this->batchId, $this->coachId);
        $this->classList = ClassModel::classList();
        $mobileDetect->isMobile() ? $this->isMobile = true : $this->isMobile = false;
        $mobileDetect->isTablet() ? $this->isTablet = true : $this->isTablet = false;
    }

    public function updated($property) {
        if ($property == 'searchMember') {
            $this->resetPage();
            $this->members = Member::coachActiveMembersSearch($this->batchId, $this->coachId, $this->searchMember);
        }

        if ($property == 'filterClass') {
            $this->resetPage();
            if ($this->filterClass == 0) {
                $this->members = Member::coachActiveMembers($this->batchId, $this->coachId);
            } else {
                $this->members = Member::memberInClass($this->batchId, $this->filterClass, $this->coachId);
                $this->activeMemberInClass = Member::activeMemberInClass($this->batchId, $this->coachId, $this->filterClass);
            }
        }
    }

    public function loadMore() {
        $this->limitData += 9;
    }

    public function render()
    {
        // return view('livewire.coach.database.active-members');
        return view('livewire.coach.database.vuexy-reguler-member');
    }
}
