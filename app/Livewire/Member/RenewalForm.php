<?php

namespace App\Livewire\Member;

use App\Models\User;
use App\Models\Batch;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;

class RenewalForm extends Component
{
    use WithFileUploads;

    #[Locked]
    public $batchId;

    public $fileUpload;
    public $programs = [];
    public $coaches = [];
    public $classes = [];
    public $selectedProgram;
    public $selectedCoach;
    public $selectedClass;
    public $price;
    public $showProgressBar = false;

    public function mount() {
        $this->programs = Program::all();
        $batch = Batch::orderBy('id', 'desc')->first();
        $this->batchId = $batch->id;
    }

    public function updated($property) {
        if ($property == 'selectedProgram') {
            $this->coaches = Pricelist::showCoachBasedOnProgram($this->selectedProgram);
            $this->reset(['selectedCoach', 'selectedClass']);
        }

        if ($property == 'selectedCoach') {
            $this->coaches = Pricelist::showCoachBasedOnProgram($this->selectedProgram);
            $this->classes = ClassModel::where('coach_code', $this->selectedCoach)->get();
            $pricelist = Pricelist::where('program_id', $this->selectedProgram)
                ->where('coach_code', $this->selectedCoach)
                ->first();
            $priceNumber = $pricelist->price_per_person;
            $this->price = 'Rp '.number_format($priceNumber,0,',','.');
        }
    }

    public function selectFile() {
        $this->showProgressBar = true;
    }

    public function updatedfileUpload() {
        $this->validate(
            [
                'fileUpload' => 'mimes:png,jpg,jpeg|max:1024',
            ],
            [
                'fileUpload.max' => 'Ukuran file tidak boleh lebih dari 1 MB, silahkan upload ulang!',
                'fileUpload.mimes' => 'File harus dalam format gambar: .jpg/.jpeg/.png, silahkan upload ulang!',
            ]
        );
    }

    public function render()
    {
        return view('livewire.member.renewal-form');
    }
}
