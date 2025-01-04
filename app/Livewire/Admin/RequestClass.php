<?php

namespace App\Livewire\Admin;

use App\Models\ClassModel;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class RequestClass extends Component
{
    //Array
    public $filter;
    //Object
    public $detailClass;
    //String
    public $statusNewMember, $statusRenewal;

    #[Layout('layouts.vuexy-app')]
    #[Title('Request Class')]

    #[Computed]
    public function listClasses() {
        return ClassModel::classByFilter($this->filter)->orderBy('id', 'desc')->get();
    }

    public function mount() {
        $this->filter = collect([
            'status' => 'Pending',
        ]);
    }

    public function approve($id) {
        $this->detailClass = ClassModel::with([
            'program',
            'coach'
        ])
        ->where('id', $id)
        ->firstOrFail();

        $this->statusNewMember = $this->detailClass->class_status_eksternal;
        $this->statusRenewal = $this->detailClass->class_status;
    }

    public function proccessRequest() {
        ClassModel::where('id', $this->detailClass->id)->update([
            'class_status' => $this->statusRenewal,
            'class_status_eksternal' => $this->statusNewMember
        ]);

        $this->dispatch('class-approved');
        $this->redirect(route('admin::request_class'), navigate:true);
    }

    public function render()
    {
        // return view('livewire.admin.request-class');
        return view('livewire.admin.vuexy-request-class');
    }
}
