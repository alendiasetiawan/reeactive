<?php

namespace App\Livewire\Coach\Database;

use App\Models\Program;
use Livewire\Component;
use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\SpecialRegistration;
use Detection\MobileDetect;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class OpenClassMember extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Database Peserta Kelas Lepasan')]

    //String
    public $searchMember = '';
    //Integer
    public $filterClass = 0, $filterProgram = 0, $coachId, $startedParticipants, $limitData = 9;
    //Object
    public $classList, $programList;
    //Boolean
    public $isMobile;

    //PROPERTY - Total participants who join the programs
    #[Computed]
    public function participants() {
        return SpecialRegistration::countTotalParticipant($this->coachId);
    }

    //PROPERTY - Total participants who doesn't start their session
    #[Computed]
    public function notStarted() {
        return SpecialRegistration::notStartedParticipant($this->coachId)->count();
    }

    //PROPERTY - Get all participants data
    #[Computed]
    public function allParticipants() {
        return SpecialRegistration::allParticipantsPerCoach($this->coachId, $this->limitData, $this->searchMember, $this->filterData());
    }

    //HOOK - Execute at first component rendered
    public function boot(MobileDetect $mobileDetect) {
        $this->classList = ClassModel::classListLepasan(Auth::user()->email);
        $this->programList = Program::where('program_type', 'Special')->get();

        //Query to get data coach
        $coach = Coach::where('code', Auth::user()->email)->first();
        $this->coachId = $coach->id;

        //Count how many participants who has started their session
        $this->startedParticipants = $this->participants() - $this->notStarted();

        //Check is the device is mobile
        $mobileDetect->isMobile() ? $this->isMobile = true : $this->isMobile = false;
    }

    //ACTION - Set value for filter data
    public function filterData() {
        return collect([
            'classId' => $this->filterClass,
            'programId' => $this->filterProgram
        ]);
    }

    public function render()
    {
        return view('livewire.coach.database.open-class-member');
    }
}
