<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\Member;
use Livewire\Component;
use App\Services\BatchService;
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

    public function render()
    {
        return view('livewire.admin.database-member');
    }
}
