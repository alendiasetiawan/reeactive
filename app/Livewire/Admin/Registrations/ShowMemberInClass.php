<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\Member;
use Livewire\Component;
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

    protected $batchService;

    public function mount($classId, $batchId) {
        $this->members = Member::allMemberInClass($classId, $batchId);
        $this->classId = $classId;
        $this->batchId = $batchId;
    }

    public function boot(BatchService $batchService) {
        $this->batchQuery = $batchService->batchQuery();
    }

    public function updated($property) {
        if ($property == 'filterLevel') {
            $this->resetPage();
            if ($this->filterLevel == 0) {
                $this->membersInClass = Member::allMemberInClassPaginate($this->classId, $this->batchId);
            } else {

            }
        }
    }

    #[Computed]
    public function membersInClass() {
        return Member::allMemberInClassPaginate($this->classId, $this->batchId);
    }

    public function render()
    {
        return view('livewire.admin.registrations.show-member-in-class');
    }
}
