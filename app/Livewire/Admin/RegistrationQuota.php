<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\Coach;
use Livewire\Component;
use App\Models\ClassModel;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class RegistrationQuota extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Kuota Pendaftaran')]

    public object $registeredMember;
    public $selectedBatch, $selectedCoach = '', $selectedClassId;
    public string $searchMember = '';
    //Object
    public $lastBatches, $regulerCoaches;
    //Boolean
    public $isResetFilter = false;
    //String
    public $setRenewal, $setNewMember;

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

    public function save() {
        ClassModel::where('id', $this->selectedClassId)
        ->update([
            'class_status' => $this->setRenewal,
            'class_status_eksternal' => $this->setNewMember,
        ]);

        $this->dispatch('class-status-updated');
        $this->redirect(route('admin::registration_quota'), navigate:true);
    }

    public function setClassId($id) {
        $this->selectedClassId = $id;
        $queryClass = ClassModel::find($id);
        $this->setRenewal = $queryClass->class_status;
        $this->setNewMember = $queryClass->class_status_eksternal;
    }

    public function render()
    {
        // return view('livewire.admin.registration-quota');
        return view('livewire.admin.vuexy-registration-quota');
    }
}
