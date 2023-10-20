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

    public object $members;
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
        $this->members = Member::allMemberInClass($classId, $batchId);
        $this->classId = $classId;
        $this->batchId = $batchId;
        $this->nickName = $nickName;
        $this->classDetail = ClassModel::find($classId);
    }

    public function boot(BatchService $batchService) {
        $this->batchQuery = $batchService->batchQuery();
    }

    public function updated($property, $value) {
        if ($property == 'filterLevel') {
            if ($this->filterLevel == 0) {
                $this->membersInClass = Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData);
            } else {
                $this->membersInClass = Member::memberPerLevel($this->classId, $this->batchId, $this->filterLevel);
            }
        }

        if ($property == 'searchMember') {
            if ($this->searchMember == '') {
                $this->membersInClass = Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData);
            } else {
                $this->membersInClass = Member::allMemberInClassSearch($this->classId, $this->batchId, $this->searchMember);
            }
        }

        if ($property == 'selectedCoach') {
            $this->selectedCoach = $value;
        }
    }

    public function loadMore() {
        $this->limitData += 10;
    }

    #[Computed]
    public function membersInClass() {
        return Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData);
    }

    #[Computed]
    public function allMembersInClass() {
        return Member::allMemberInClass($this->classId, $this->batchId);
    }

    #[Computed]
    public function coaches() {
        return Coach::where('coach_status', 'Aktif')->pluck('nick_name', 'id');
    }

    #[Computed]
    public function classes() {
        return ClassModel::where('coach_code', $this->selectedCoach)->where('class_status', '<>', 'Pending')->get();
    }

    public function render()
    {
        return view('livewire.admin.registrations.show-member-in-class');
    }
}
