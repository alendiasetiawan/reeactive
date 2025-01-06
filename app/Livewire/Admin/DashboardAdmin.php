<?php

namespace App\Livewire\Admin;

use App\Models\Batch;
use App\Models\Coach;
use App\Models\Program;
use Livewire\Component;
use App\Models\Registration;
use App\Models\WorkshopBatch;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\WorkshopRegistration;
use App\Charts\MemberInActiveBatchChart;
use App\Charts\RegistrationCategoryChart;
use App\Models\SpecialRegistration;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class DashboardAdmin extends Component
{
    #[Layout('layouts.vuexy-app')]
    #[Title('Dashboard Admin')]

    public $renewalMember;
    public $qtyLastMember;
    public $batchId;
    public $lastBatchId;
    public bool $workshopOpen;
    public object $allWorkshopRegistration;
    //Object
    public $batchQuery, $latestRegistrationsReguler, $latestRegistrationsLepasan;
    //Double
    public $percentRenewalMember;
    //Integer
    public $totalMember, $verificationRegulerProgram, $totalIncomeReguler, $totalMemberLepasan, $verificationLepasan, $totalIncomeLepasan;

    #[Computed]
    public function barChartMemberPerCoach() {
        $dataChart = Coach::memperPerCoach($this->batchId);

        $columnChartModel = $dataChart->reduce(function ($columnChartModel, $item) {
            $totalMember = $item->registrations->count();
            $columnChartModel->addColumn($item->nick_name, $totalMember, $item->color_hex);
            return $columnChartModel;
        },
            LivewireCharts::columnChartModel()
            ->setTitle('Jumlah Member')
            ->setAnimated(true)
            ->withLegend()
            ->setDataLabelsEnabled(true)
            ->setJsonConfig([
                'tooltip.y.formatter' => '(val) => `${val}`',
                'yaxis.labels.formatter' => '(val) => `${val}`',
            ])
        );

        return $columnChartModel;
    }

    #[Computed]
    public function pieChartRegistrationType() {
        $totalNewMember = Registration::where('batch_id', $this->batchId)->where('registration_category', 'New Member')->count();
        $totalRenewalMember = Registration::where('batch_id', $this->batchId)->where('registration_category', 'Renewal Member')->count();
        $totalComeBack = Registration::where('batch_id', $this->batchId)->where('registration_category', 'Come Back')->count();

        $pieChartModel =
            (new PieChartModel())
            ->asPie()
            ->setAnimated(true)
            ->withLegend()
            ->setDataLabelsEnabled(true)
            ->addSlice('New Member', $totalNewMember, '#06ba21')
            ->addSlice('Renewal Member', $totalRenewalMember, '#1568b0')
            ->addSlice('Come Back', $totalComeBack, '#eb430c');

        return $pieChartModel;
    }

    public function mount(BatchService $batchService) {
        $this->batchQuery = $batchService->batchQuery();
        $this->batchId = $this->batchQuery->id;

        //Logic for workshop registration
        $workshopQuery = $batchService->workshopBatchQuery();
        $workshopBatchId = $workshopQuery->id;
        $this->workshopOpen = WorkshopBatch::where('batch_status', 'Open')->exists();
        $this->allWorkshopRegistration = WorkshopRegistration::where('workshop_batch_id', $workshopBatchId)->get();

        //Logic for percent renewal
        $batches = Batch::orderBy('id', 'desc')->limit(2)->get();
        $this->lastBatchId = $batches[1]->id;
        $this->renewalMember = Registration::where('batch_id', $this->batchId)->where('registration_category', 'Renewal Member')->count();
        $this->qtyLastMember = Registration::where('batch_id', $this->lastBatchId)->where('payment_status', 'Done')->count();
        $this->percentRenewalMember = $batchService->renewalMemberPercent($this->renewalMember, $this->qtyLastMember);

        //Logic for payment status board reguler Program
        $this->totalMember = Registration::where('batch_id', $this->batchId)->where('payment_status', 'Done')->count();
        $this->verificationRegulerProgram = Registration::waitingVerification($this->batchId);
        $this->totalIncomeReguler = Registration::where('batch_id', $this->batchId)->where('payment_status', 'Done')->sum('amount_pay');

        //Logic for payment status board kelas lepasan
        $this->totalMemberLepasan = SpecialRegistration::where('payment_status', 'Done')->count();
        $this->verificationLepasan = SpecialRegistration::waitingVerification();
        $this->totalIncomeLepasan = SpecialRegistration::where('payment_status', 'Done')->sum('amount_pay');

        //Logic for latest registration
        $this->latestRegistrationsReguler = Registration::limitLatestRegistration($this->batchId, 4);
        $this->latestRegistrationsLepasan = SpecialRegistration::limitLatestRegistration(4);
    }

    public function render()
    {
        // return view('livewire.admin.dashboard-admin');
        return view('livewire.admin.vuexy-dashboard-admin');
    }
}
