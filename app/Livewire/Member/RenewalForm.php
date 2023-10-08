<?php

namespace App\Livewire\Member;

use App\Models\Batch;
use App\Models\Program;
use Livewire\Component;
use App\Models\Pricelist;
use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\Registration;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Auth;

class RenewalForm extends Component
{
    use WithFileUploads;

    #[Locked]
    public $batchId;

    public $batchOpen;
    public $batchName;
    public $fileUpload;
    public $programs = [];
    public $coaches = [];
    public $classes = [];
    public $selectedProgram;
    public $selectedCoach;
    public $selectedClass;
    public $price;
    public $showProgressBar = false;
    public $uploadedFileName;
    public $registrationCategory;

    public function boot() {
        $this->programs = Program::all();
        $batch = Batch::orderBy('id', 'desc')->first();
        $this->batchId = $batch->id;
        $this->batchName = $batch->batch_name;
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

        if ($property == 'fileUpload') {
            $this->validate(
                [
                    'fileUpload' => 'mimes:png,jpg,jpeg|max:1024',
                ],
                [
                    'fileUpload.max' => 'Ukuran file tidak boleh lebih dari 1 MB, silahkan upload ulang!',
                    'fileUpload.mimes' => 'File harus dalam format gambar: .jpg/.jpeg/.png, silahkan upload ulang!',
                ]
            );

            $this->coaches = Pricelist::showCoachBasedOnProgram($this->selectedProgram);
            $this->classes = ClassModel::where('coach_code', $this->selectedCoach)->get();
            $this->uploadedFileName = time().'.'.$this->fileUpload->extension();
        }
    }

    public function selectFile() {
        $this->showProgressBar = true;
        $this->coaches = Pricelist::showCoachBasedOnProgram($this->selectedProgram);
        $this->classes = ClassModel::where('coach_code', $this->selectedCoach)->get();
    }

    public function getCheckBatchProperty() {
        $checkBatch = Batch::checkRegisteredBatch();

        return $checkBatch;
    }

    public function saveData() {
        $coach = Coach::where('code', $this->selectedCoach)->first();
        $registration = Registration::lastRegistrationData();
        $priceStr = preg_replace("/[^0-9]/","", $this->price);
        $priceInt = (int) $priceStr;

        Registration::insert([
            'member_code' => Auth::user()->email,
            'batch_id' => $this->batchId,
            'amount_pay' => $priceInt,
            'file_upload' => $this->fileUpload->storeAs($this->batchName, $this->uploadedFileName, 'public'),
            'payment_status' => 'Process',
            'registration_category' => $this->registrationCategory,
            'program_id' => $this->selectedProgram,
            'level_id' => $registration->level_id,
            'coach_id' => $coach->id,
            'class_id' => $this->selectedClass,
        ]);

        session()->flash('registrationSuccess', 'Success');
        $this->redirect('/member/renewal-registration', navigate:true);

    }

    public function render()
    {
        $data = [
            'checkBatch' => $this->checkBatch,
        ];

        return view('livewire.member.renewal-form', $data);
    }
}
