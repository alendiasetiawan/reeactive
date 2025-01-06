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
    public $selectedBatch, $selectedCoach = '';
    public string $searchMember = '';
    //Object
    public $lastBatches, $regulerCoaches;
    //Boolean
    public $isResetFilter = false;

    //HOOK - Execute once when component is rendered
    public function mount(BatchService $batchService) {
        $this->selectedBatch = $batchService->batchIdActive();
        $this->lastBatches = Batch::orderBy('id', 'desc')->limit(5)->get();
        $this->regulerCoaches = Coach::listRegulerCoaches();
    }

    #[Computed]
    public function membersPerCoach() {
        return Coach::membersClassPerCoach($this->selectedBatch, $this->selectedCoach);
    }

    public function updated($property) {
        if ($property == 'selectedBatch') {
            $this->isResetFilter = true;
        }
    }

    public function render()
    {
        // return view('livewire.admin.registration-quota');
        return view('livewire.admin.vuexy-registration-quota');
    }
}
