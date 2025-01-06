<?php

namespace App\Livewire\Admin\Database;

use App\Models\Coach;
use Livewire\Component;
use App\Models\ClassModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class LepasanClass extends Component
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
    public function mount() {
        $this->regulerCoaches = Coach::listRegulerCoaches();
    }

    #[Computed]
    public function membersPerCoach() {
        return Coach::listLepasanClass($this->selectedCoach);
    }

    public function setClassId($id) {
        $this->selectedClassId = $id;
        $queryClass = ClassModel::find($id);
        $this->setRenewal = $queryClass->class_status;
        $this->setNewMember = $queryClass->class_status_eksternal;
    }

    public function save() {
        ClassModel::where('id', $this->selectedClassId)
        ->update([
            'class_status' => $this->setRenewal,
            'class_status_eksternal' => $this->setNewMember,
        ]);

        $this->dispatch('class-status-updated');
        $this->redirect(route('admin::lepasan_class'), navigate:true);
    }

    public function render()
    {
        return view('livewire.admin.database.lepasan-class');
    }
}
