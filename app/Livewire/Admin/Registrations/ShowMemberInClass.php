<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class ShowMemberInClass extends Component
{
    #[Layout('layouts.app')]
    #[Title('Data Member Per Kelas')]

    public object $batchQuery;
    public int $filterLevel;
    public int $classId;
    public int $batchId;
    public string $nickName;
    public int $limitData = 6;
    public string $searchMember = '';
    public object $classDetail;
    public int $selectedLevel;
    public int $selectedCoach;
    public int $selectedClass;

    protected $batchService;

    public function mount($classId, $batchId, $nickName) {
        $this->classId = $classId;
        $this->batchId = $batchId;
        $this->nickName = $nickName;
        $this->classDetail = ClassModel::find($classId);
    }

    public function boot(BatchService $batchService) {
        $this->batchQuery = $batchService->batchQuery();
    }

    #[Computed]
    public function membersInClass() {
        return Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData);
    }

    #[Computed]
    public function allMembersInClass() {
        return Member::allMemberInClass($this->classId, $this->batchId);
    }

    public function updated($property) {
        if ($property == 'filterLevel') {
            $this->reset('searchMember');
            if ($this->filterLevel == 0) {
                $this->membersInClass = Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData);
            } else {
                $this->membersInClass = Member::memberPerLevel($this->classId, $this->batchId, $this->filterLevel);
            }
        }

        if ($property == 'searchMember') {
            $this->reset('filterLevel');
            if ($this->searchMember == '') {
                $this->membersInClass = Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData);
            } else {
                $this->membersInClass = Member::allMemberInClassSearch($this->classId, $this->batchId, $this->searchMember);
            }
        }
    }

    public function loadMore() {
        $this->limitData += 10;
    }

    public function render()
    {
        return view('livewire.admin.registrations.show-member-in-class');
    }
}
