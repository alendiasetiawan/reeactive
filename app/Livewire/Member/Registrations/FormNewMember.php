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
    #[Title('Form Pendaftaran Member Baru')]

    public $batch;
    public $programs;
    public $selectedProgram;
    public $selectedCoach;

    public $totalSteps = 4;
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

    public function render()
    {
        return view('livewire.member.registrations.form-new-member');
    }
}
