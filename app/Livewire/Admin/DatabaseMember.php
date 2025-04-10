<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Services\BatchService;
use Detection\MobileDetect;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class DatabaseMember extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Database Member')]

    protected $batchService;

    public $batchName;
    public $batchId;
    public $batches = [];
    public $selectedCoach = '';
    public $selectedClass = '';
    public $isDisabledButton = true;
    public $isTablet, $isMobile;
    public $searchMember = '';
    public $limitData = 9;

    public function mount(BatchService $batchService) {
        $this->batchId = $batchService->batchIdActive();
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;
        $this->batches = Batch::orderBy('id', 'desc')->limit(10)->get();
    }

    public function boot(MobileDetect $mobileDetect) {
        $mobileDetect->isTablet() ? $this->isTablet = true : $this->isTablet = false;
        $mobileDetect->isMobile() ? $this->isMobile = true : $this->isMobile = false;
    }

    #[Computed]
    public function membersActive() {
        return Member::memberActive($this->batchId, $this->searchMember, $this->limitData);
    }

    #[Computed]
    public function coaches() {
        return Coach::where('type', 'Reguler')
        ->where(function($query) {
            $query->orWhere('coach_status', 'Aktif')
            ->orWhere('coach_status_eksternal', 'Aktif');
        })
        ->orderBy('nick_name', 'asc')
        ->get();
    }

    #[Computed]
    public function classes() {
        $coach = Coach::find($this->selectedCoach);
        $coachCode = $coach->code;

        return ClassModel::where('coach_code', $coachCode)->get();
    }

    public function updatedSelectedCoach() {
        $this->reset('selectedClass');
    }

    public function loadMore() {
        $this->limitData += 18;
    }

    public function changeBatch($id) {
        $this->batchId = $id;
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;
    }

    public function render()
    {
        // return view('livewire.admin.database-member');
        return view('livewire.admin.vuexy-database-member');
    }
}
