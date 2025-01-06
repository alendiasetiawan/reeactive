<?php

namespace App\Livewire\Admin\Database;

use Livewire\Component;
use App\Models\ClassModel;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Services\SpecialRegistrationService;
use Detection\MobileDetect;

class ParticipantsInClass extends Component
{
    #[Title('Peserta Dari Kelas Lepasan')]
    #[Layout('layouts.vuexy-app')]

    //Integer
    public $classId, $limitData = 9;
    //String
    public $searchMember = '';
    //Boolean
    public $isMobile;

    protected SpecialRegistrationService $specialRegistrationService;

    //PROPERTY - Detail data class
    #[Computed]
    public function classDetail() {
        return ClassModel::memberPerClass($this->classId);
    }

    //PROPERTY - Count how many participants in class
    #[Computed]
    public function totalParticipants() {
        return $this->specialRegistrationService->totalParticipantInClass($this->classId);
    }

    //PROPERTY - Get all participants in class
    #[Computed]
    public function participantsInClass() {
        return $this->specialRegistrationService->paginateParticipantInClass($this->classId, $this->limitData, $this->searchMember);
    }

    //HOOK - Execute once when component is rendered
    public function mount($classId) {
        $this->classId = $classId;
    }

    //HOOK - Execute every time component is rendered
    public function boot(SpecialRegistrationService $specialRegistrationService, MobileDetect $mobileDetect) {
        $this->specialRegistrationService = $specialRegistrationService;
        $mobileDetect->isMobile() ? $this->isMobile = true : $this->isMobile = false;
    }

    //ACTION - Load more data
    public function loadMore() {
        $this->limitData += 18;
    }

    public function render()
    {
        return view('livewire.admin.database.participants-in-class');
    }
}
