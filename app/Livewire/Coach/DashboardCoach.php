<?php

namespace App\Livewire\Coach;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Member;
use Livewire\Component;
use App\Models\ClassModel;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Helpers\EnumValueHelper;
use App\Models\SpecialRegistration;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DashboardCoach extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Dashboard Coach')]

    protected $batchService;

    //Object
    public $membersInClass, $membersOpenClass, $classLargeGroup;
    //Integer
    public $batchId, $batchNumber, $activeMemberOpenClass;
    //String
    public $batchName, $classId;
    public $activeMember;

    public function boot(BatchService $batchService) {

        $coach = Coach::where('code', Auth::user()->email)->first();
        $coachId = $coach->id;

        $this->batchId = $batchService->batchIdActive();
        $batch = Batch::find($this->batchId);
        $this->batchName = $batch->batch_name;
        $explodeBatch = explode(' ', $this->batchName);
        $this->batchNumber = $explodeBatch[1];

        $this->membersInClass = ClassModel::memberPerCoach($this->batchId, $coachId);
        $this->activeMember = Member::activeMemberPerCoach($this->batchId, $coachId);
        $this->membersOpenClass = ClassModel::memberPerCoachLepasan($coachId);
        $this->activeMemberOpenClass = SpecialRegistration::where('coach_id', $coachId)->where('payment_status', 'Done')->count();
        $this->classLargeGroup = ClassModel::classListByCoach($coach->code);
    }

    //ONCLICK - Set value for query edit class modal
    public function setValueClass($id) {
        try {
            $realId = Crypt::decrypt($id);
            $this->classId = $realId;
        } catch (DecryptException) {
            session()->flash('invalid-id', 'Stop! Dilarang Melakukan Modifikasi ID Parameter');
        }
    }

    public function render()
    {
        // return view('livewire.coach.dashboard-coach');
        return view('livewire.coach.vuexy-dashboard-coach');
    }
}
