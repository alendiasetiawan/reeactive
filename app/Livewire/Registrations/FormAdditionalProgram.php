<?php

namespace App\Livewire\Registrations;

use App\Models\Coach;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

class FormAdditionalProgram extends Component
{
    #[Title('Form Pendaftaran Program Lepas')]

    //Integer
    public $countryId, $provinceId, $regencyId, $districtId, $ageStart, $bodyHeight, $bodyWeight, $countryCode, $phone, $selectedProgram = '', $selectedCoach = '', $selectedClass = '', $selectedSession = null;
    //String
    public $memberName, $birthDate, $address;
    //Array
    public $inputsDate = ['0'], $sessionDate = [];
    //Object
    public $programs;

    #[Computed]
    public function coaches() {
        return Pricelist::showActiveCoachEksternal($this->selectedProgram);
    }

    #[Computed]
    public function classes() {
        return ClassModel::showActiveClassExternal($this->selectedProgram, $this->selectedCoach);
    }

    //HOOK - Execute once when component is rendered
    public function mount() {
        $this->programs = Program::where('program_type', 'Special')->where('program_status', 'Open')->get();
    }

    //HOOK - Check if property updated
    public function updated($property) {
    }

    public function render()
    {

        return view('livewire.registrations.form-additional-program')->layout('layouts.vuexy-blank');
    }
}
