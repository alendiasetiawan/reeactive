<?php

namespace App\Livewire\Member\Registrations;

use App\Models\Pricelist;
use App\Models\Program;
use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class FormNewMember extends Component
{
    #[Layout('layouts.blank')]
    #[Title('Pendaftaran Member Baru')]

    public $batch;
    public $programs;
    public $selectedProgram;
    public $selectedCoach;
    public $poinSatu;
    public $poinDua;
    public $poinTiga;
    public $poinEmpat;
    public $poinLima;
    public $poinEnam;
    public $questionOne;
    public $conclusionOne;
    public $questionTwo;
    public $questionThree;
    public $closeRegistration = false;

    public $totalSteps = 2;
    public $currentStep = 1;

    protected $batchService;

    public function mount(BatchService $batchService) {
        $this->batch = $batchService->batchQuery();
        $this->programs = Program::where('program_status', 'Open')->get();
        $this->currentStep = 1;
    }

    #[Computed]
    public function coaches() {
        return Pricelist::showCoachBasedOnProgram($this->selectedProgram);
    }

    public function increaseStep() {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep += 1;
    }

    public function decreaseStep() {
        $this->resetErrorBag();
        $this->currentStep -= 1;

        if($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData() {

        if($this->currentStep == 1) {
            $this->validate(
                [
                    'poinSatu' => 'accepted',
                    'poinDua' => 'accepted',
                    'poinTiga' => 'accepted',
                    'poinEmpat' => 'accepted',
                    'poinLima' => 'accepted',
                    'poinEnam' => 'accepted',
                ],
                [
                    'poinSatu.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinDua.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinTiga.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinEmpat.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinLima.accepted' => 'Anda belum setuju dengan akad ini',
                    'poinEnam.accepted' => 'Anda belum setuju dengan akad ini',
                ]
            );
        }
        if ($this->currentStep == 2) {

        }
        if ($this->currentStep == 3) {

        }
    }

    public function updated($property, $value) {
        if ($property == 'questionOne') {
            $this->reset('questionTwo', 'questionThree');
        }

        if($property == 'questionThree') {
            if ($value == 'Less') {
                $this->closeRegistration = true;
            } else {
                $this->closeRegistration = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.member.registrations.form-new-member');
    }
}
