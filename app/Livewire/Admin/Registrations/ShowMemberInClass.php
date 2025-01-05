<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Services\BatchService;
use Detection\MobileDetect;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class ShowMemberInClass extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Data Member Per Kelas')]

    public object $batchQuery;
    public $filterLevel = '';
    public int $classId;
    public int $batchId;
    public string $nickName;
    public int $limitData = 9;
    public string $searchMember = '';
    public object $classDetail;
    public int $selectedLevel;
    public int $selectedCoach;
    public int $selectedClass;
    //Boolean
    public $isMobile, $isTablet;

    protected $batchService;

    public function mount($classId, $batchId, $nickName) {
        $this->classId = $classId;
        $this->batchId = $batchId;
        $this->nickName = $nickName;
        $this->classDetail = ClassModel::find($classId);
    }

    public function boot(BatchService $batchService, MobileDetect $mobileDetect) {
        $this->batchQuery = $batchService->batchQuery();
        $mobileDetect->isMobile() ? $this->isMobile = true : $this->isMobile = false;
        $mobileDetect->isTablet() ? $this->isTablet = true : $this->isTablet = false;
    }

    #[Computed]
    public function membersInClass() {
        return Member::allMemberInClassMore($this->classId, $this->batchId, $this->limitData, $this->filterData());
    }

    #[Computed]
    public function allMembersInClass() {
        return Member::allMemberInClass($this->classId, $this->batchId);
    }

    public function loadMore() {
        $this->limitData += 10;
    }

    public function filterData() {
        return collect([
            'searchMember' => $this->searchMember,
            'filterLevel' => $this->filterLevel
        ]);
    }

    public function render()
    {
        // return view('livewire.admin.registrations.show-member-in-class');
        return view('livewire.admin.registrations.vuexy-show-member-in-class');
    }
}
