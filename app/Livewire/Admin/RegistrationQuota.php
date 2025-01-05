<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\Coach;
use App\Services\BatchService;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class RegistrationQuota extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Kuota Pendaftaran')]

    public object $registeredMember;
    public $selectedBatch;
    public string $searchMember = '';
    //Object
    public $lastBatches;

    //HOOK - Execute once when component is rendered
    public function mount(BatchService $batchService) {
        $this->selectedBatch = $batchService->batchIdActive();
        $this->lastBatches = Batch::orderBy('id', 'desc')->limit(5)->get();
    }

    #[Computed]
    public function membersPerCoach() {
        return Coach::membersClassPerCoach($this->selectedBatch);
    }

    public function render()
    {
        // return view('livewire.admin.registration-quota');
        return view('livewire.admin.vuexy-registration-quota');
    }
}
