<?php

namespace App\Livewire\Member\Registrations;

use Exception;
use Carbon\Carbon;
use App\Models\Coach;
use App\Models\Program;
use Livewire\Component;
use App\Models\ClassDate;
use App\Models\Pricelist;
use App\Models\ClassModel;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\SpecialRegistration;
use Illuminate\Support\Facades\Auth;

class OpenClassRegistration extends Component
{
    use WithFileUploads;

    #[Layout('layouts.vuexy-app')]
    #[Title('Daftar Kelas Lepasan')]

    //Integer
    public $selectedProgram = '', $selectedClass = '', $selectedSession, $pregnantWeek, $programPrice, $totalPrice;
    //String
    public $selectedCoach = '', $isPregnantSyndrom, $pregnantSyndromDetail, $programName, $fileUpload, $selectedDay, $uploadedFileName, $folderName;
    //Array
    public array $selectedDate = [];
    //Object
    public $programs;
    //Boolean
    public $invalidDay, $isPregnantFriendly, $isAllowedToJoin, $isSubmitActive, $showProgressBar;

    protected $rules = [
        'pregnantWeek' => 'required|integer|min:1|max:40',
        'pregnantSyndromDetail' => 'required|min:10|max:500',
        'fileUpload' => 'mimes:png,jpg,jpeg|max:1024',
    ];

    protected $messages = [
        'pregnantWeek.required' => 'Usia kandungan harus diisi!',
        'pregnantWeek.min' => 'Minimal 1 minggu',
        'pregnantWeek.max' => 'Maksimal 40 minggu',
        'pregnantSyndromDetail.min' => 'Minimal 10 karakter',
        'pregnantSyndromDetail.max' => 'Maksimal 500 karakter',
        'pregnantSyndromDetail.required' => 'Tolong tulis detail keluhan kamu ya ^^',
        'fileUpload.max' => 'Ukuran file tidak boleh lebih dari 1 MB.',
        'fileUpload.mimes' => 'File harus dalam format gambar: .jpg/.jpeg/.png.',
    ];

    #[Computed]
    public function coaches() {
        return Pricelist::showActiveCoachEksternal($this->selectedProgram);
    }

    #[Computed]
    public function classes() {
        return ClassModel::showActiveClassExternal($this->selectedProgram, $this->selectedCoach);
    }

    #[Computed]
    public function latestRegistrations() {
        return SpecialRegistration::latestRegistration(Auth::user()->email, 3);
    }

    #[Computed]
    public function isRegistrationProcess() {
        return SpecialRegistration::isRegistrationProcess(Auth::user()->email);
    }

    //HOOK - Execute at first component rendered
    public function mount() {
        $this->programs = Program::where('program_type', 'Special')->where('program_status', 'Open')->get();
        $this->folderName = Carbon::now()->isoFormat('MMMM Y');
    }

    //HOOK - Execute when property changed
    public function updated($property) {
        $this->isFormFilled();

        if ($property == 'selectedClass') {
            $class = ClassModel::find($this->selectedClass);
            $this->selectedDay = $class->day;
            $this->classStartTime = $class->start_time;
            $this->classEndTime = $class->end_time;
        }

        if ($property == 'selectedProgram') {
            $program = Program::where('id', $this->selectedProgram)->first();
            $this->isPregnantFriendly = $program->is_pregnant_friendly;
            $this->programName = $program->program_name;

            $this->reset(['selectedCoach', 'selectedClass', 'selectedSession', 'selectedDate', 'pregnantWeek', 'isPregnantSyndrom', 'pregnantSyndromDetail']);
        }

        if (str_contains($property, 'selectedDate.')) {
            if (preg_match('/\.(\d+)/', $property, $matches)) {
                $index = $matches[1];
                $this->checkDay($index);
            }

            if ($this->checkDay($index) == true) {
                $this->invalidDay = false;
            } else {
                $this->invalidDay = true;
            }

        }

        if ($property == 'selectedSession') {
            //Setup program price
            $price = Pricelist::where('coach_code', $this->selectedCoach)
            ->where('program_id', $this->selectedProgram)
            ->select('coach_code', 'price', 'price_per_person')
            ->first();

            if ($this->selectedSession == 1) {
                $this->programPrice = $price->price_per_person;
            } else {
                $this->programPrice = $price->price;
            }

            $this->totalPrice = $this->programPrice;

            $this->reset(['selectedDate', 'pregnantWeek', 'isPregnantSyndrom', 'pregnantSyndromDetail', 'fileUpload']);
            $this->resetValidation('selectedDate', 'fileUpload');

            if ($this->isPregnantFriendly == 0) {
                $this->validateOnly('pregnantWeek');
            } else {
                $this->resetValidation('pregnantWeek');
            }
        }

        if ($property == 'pregnantWeek') {
            if ($this->pregnantWeek < 12) {
                $this->isAllowedToJoin = false;
            } else {
                $this->isAllowedToJoin = true;
            }
            $this->validateOnly('pregnantWeek');
        }

        if ($property == 'isPregnantSyndrom') {
            if ($this->isPregnantSyndrom == 'Yes') {
                $this->validateOnly('pregnantSyndromDetail');
            } else {
                $this->resetValidation('pregnantSyndromDetail');
            }

            $this->reset('pregnantSyndromDetail');
        }

        if ($property == 'pregnantSyndromDetail') {
            $this->validateOnly('pregnantSyndromDetail');
        }

        if ($property == 'fileUpload') {
            $this->uploadedFileName = time().'.'.$this->fileUpload->extension();
            $this->validateOnly('fileUpload');
        }
    }

    //ACTION - Check if selected date is match with days provided
    public function checkDay($index) {
        $numberDay = Carbon::parse($this->selectedDate[$index])->format('N');

        $checkDay = ClassModel::where('id', $this->selectedClass)
        ->where('day', 'LIKE', '%'.$numberDay.'%')
        ->exists();

        return $checkDay;
    }

    //ACTION - show prgress bar when user upload file
    public function selectFile() {
        $this->showProgressBar = true;
    }

    //ACTION - Check if all field has been filled
    public function isFormFilled() {
        if (!empty($this->selectedClass) && !empty($this->selectedSession) && !empty($this->selectedProgram) && !empty($this->selectedCoach) && !empty($this->fileUpload) ) {
            $this->isSubmitActive = true;
        } else {
            $this->isSubmitActive = false;
        }
    }

    //ACTION - Submit form
    public function register() {
        $queryCoach = Coach::where('code', $this->selectedCoach)->first();

        DB::beginTransaction();
        try {
            //Store data to table special registration and grab it's id
            $registration = SpecialRegistration::create([
                'member_code' => Auth::user()->email,
                'amount_pay' => $this->totalPrice,
                'program_price' => $this->programPrice,
                'file_upload' => $this->fileUpload->storeAs($this->folderName, $this->uploadedFileName, 'public'),
                'payment_status' => 'Process',
                'program_id' => $this->selectedProgram,
                'coach_id' => $queryCoach->id,
                'class_id' => $this->selectedClass
            ]);

            //Store data to table class_dates and using id from table special registration
            foreach ($this->selectedDate as $date) {
                ClassDate::create([
                    'special_registration_id' => $registration->id,
                    'date' => $date
                ]);
            }

            DB::commit();
            $this->dispatch('registration-success');
            $this->redirect(route('member::open_class_registration'), navigate:true);
        } catch (Exception) {
            DB::rollBack();
            session()->flash('registration-failed', 'Daftar Gagal, Cek Koneksi dan Kolom Isian Anda');
        }
    }

    public function render()
    {
        return view('livewire.member.registrations.open-class-registration');
    }
}
