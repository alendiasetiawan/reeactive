<?php

namespace App\Livewire\Admin\Registrations;

use App\Models\ClassModel;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FormClassStatus extends Component
{
    public $statusNewMember;
    public $statusRenewal;
    public $setNewMember;
    public $setRenewal;
    public $coach;
    public $day;
    public $start;
    public $end;
    public $programName;
    public $modalType;

    #[Locked]
    public $classId;

    public function mount() {
        $this->setNewMember = $this->statusNewMember;
        $this->setRenewal = $this->statusRenewal;
    }

    public function save() {
        ClassModel::where('id', $this->classId)
        ->update([
            'class_status' => $this->setRenewal,
            'class_status_eksternal' => $this->setNewMember,
        ]);

        $this->dispatch('class-status-updated');

        if ($this->modalType == 'kelasReguler') {
            $this->redirect(route('admin::registration_quota'), navigate:true);
        } else {
            $this->redirect(route('admin::lepasan_class'), navigate:true);
        }
    }

    public function render()
    {
        return view('livewire.admin.registrations.form-class-status');
    }
}
