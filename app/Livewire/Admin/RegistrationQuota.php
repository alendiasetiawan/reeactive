<?php

namespace App\Livewire\Admin;

use App\Models\Coach;
use App\Services\BatchService;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class RegistrationQuota extends Component
{
    #[Layout('layouts.app')]
    #[Title('Kuota Pendaftaran')]

    public object $registeredMember;
    public int $batchId;
    public string $searchMember = '';

    public function boot(BatchService $batchService) {
        $this->batchId = $batchService->batchIdActive();
    }

    #[Computed]
    public function membersPerCoach() {
        return Coach::membersClassPerCoach($this->batchId);
    }

    public function render()
    {
        return view('livewire.admin.registration-quota');
    }
}
