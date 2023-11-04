<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class DatabaseMember extends Component
{
    #[Layout('layouts.app')]
    #[Title('Database Member')]

    protected $batchService;

    public $members = [];
    public $batchName;
    public $batchId;
    public $batches = [];

    public function mount(BatchService $batchService) {
        $this->batchId = $batchService->batchIdActive();
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;
        $this->members = Member::memberActive($this->batchId);
        $this->batches = Batch::all();
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

    public function render()
    {
        return view('livewire.admin.database-member');
    }
}
