<?php

namespace App\Livewire\Coach\Database;

use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Helpers\EnumValueHelper;
use Exception;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClassRoom extends Component
{
    //Object
    public $listPrograms, $listProgramsLepasan;
    //Integer
    public $selectedProgram = '', $classId;
    //String
    public $day, $startTime, $endTime, $linkWa, $decryptId, $programName;
    //Boolean
    public $isSubmitActive = false, $isClassFound = false, $isFormReguler = false, $isFormLepasan = false, $isHaveKelasLepasan = false;
    //Array
    public $listOfDays, $selectedDays = [];

    #[Layout('layouts.vuexy-app')]
    #[Title('Daftar Kelas Coach')]

    #[Computed]
    public function programs() {
        return Program::regulerClassList();
    }

    #[Computed]
    public function lepasanPrograms() {
        return Program::lepasanClassList();
    }

    public function boot() {
        $this->listPrograms = Program::where('program_type', 'Reguler')->get();
        $this->listProgramsLepasan = Program::where('program_type', 'Special')->get();
        $this->listOfDays = [
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu',
            '7' => 'Minggu'
        ];

        $this->isHaveKelasLepasan = ClassModel::checkCoachLepasan(Auth::user()->email);
    }

    //Check if all fields reguler form are filled
    public function isFormRegulerFilled() {
        if(!empty($this->selectedProgram) && !empty($this->day) && !empty($this->startTime) && !empty($this->endTime) && !empty($this->linkWa)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    //Check if all fields in lepasan form are filled
    public function isFormLepasanFilled() {
        if(!empty($this->selectedProgram) && !empty($this->selectedDays) && !empty($this->startTime) && !empty($this->endTime) && !empty($this->linkWa)) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    public function updated() {
        if ($this->isFormReguler) {
            $this->isFormRegulerFilled();
        }

        if ($this->isFormLepasan) {
            $this->isFormLepasanFilled();
        }
    }

    public function setValueClass($id) {
        $this->decryptId = Crypt::decrypt($id);
        $checkClass = ClassModel::where('id', $this->decryptId)->exists();

        if($checkClass) {
            $this->isClassFound = true;
            $class = ClassModel::with('program')
            ->where('id', $this->decryptId)
            ->firstOrFail();

            $this->classId = $class->id;
            $this->programName = $class->program->program_name;
            $this->day = $class->day;
            $this->startTime = $class->start_time;
            $this->endTime = $class->end_time;
            $this->linkWa = $class->link_wa;
        } else {
            $this->isClassFound = false;
        }
    }

    //Reset all property before add new class
    public function addClass() {
        $this->reset(['isClassFound', 'selectedProgram', 'programName', 'day', 'startTime', 'endTime', 'linkWa']);
    }

    //Add new class
    public function sendRequest() {
        if ($this->isFormReguler) {
            $days = $this->day;
        }

        if ($this->isFormLepasan) {
            $days = implode(', ', $this->selectedDays);
        }

        DB::beginTransaction();
        try {
            ClassModel::create([
                'coach_code' => Auth::user()->email,
                'program_id' => $this->selectedProgram,
                'start_time' => $this->startTime,
                'end_time' => $this->endTime,
                'day' => $days,
                'link_wa' => $this->linkWa,
                'class_status' => 'Pending',
                'class_status_eksternal' => 'Pending'
            ]);

            Pricelist::updateOrCreate([
                'program_id' => $this->selectedProgram,
                'coach_code' => Auth::user()->email
            ], [
                'price' => EnumValueHelper::FOUR_SESSION_LEPASAN_PRICE,
                'price_per_person' => EnumValueHelper::ONE_SESSION_LEPASAN_PRICE,
            ]);

            DB::commit();
            $this->dispatch('request-sent');
            $this->redirect(route('coach::class_room'), navigate:true);
        } catch (Exception) {
            DB::rollBack();
            session()->flash('request-failed', 'Gagal menambahkan kelas, Cek Koneksi dan Kolom Isian Anda');
        }
    }

    //ACTION - Set form type to reguler
    public function setFormReguler() {
        $this->isFormReguler = true;
        $this->isFormLepasan = false;
        $this->resetForm();
    }

    //ACTION - Set form type to lepasan
    public function setFormLepasan() {
        $this->isFormReguler = false;
        $this->isFormLepasan = true;
        $this->resetForm();
    }

    //ACTION - Reset all form fields
    public function resetForm() {
        return $this->reset(['selectedProgram', 'selectedDays', 'day', 'startTime', 'endTime', 'linkWa', 'isSubmitActive']);
    }

    public function render()
    {
        // return view('livewire.coach.database.class-room');
        return view('livewire.coach.database.vuexy-class-room');
    }
}
