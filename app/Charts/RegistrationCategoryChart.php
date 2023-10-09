<?php

namespace App\Charts;

use App\Models\Registration;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class RegistrationCategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($batchId)
    {
        $newMember = Registration::where('batch_id', $batchId)
        ->where('registration_category', 'New Member')
        ->count();

        $renewalMember = Registration::where('batch_id', $batchId)
        ->where('registration_category', 'Renewal Member')
        ->count();

        $comeBack = Registration::where('batch_id', $batchId)
        ->where('registration_category', 'Come Back')
        ->count();

        return $this->chart->donutChart()
            ->addData([$newMember, $renewalMember, $comeBack])
            ->setHeight(290)
            ->setColors(['#008eff','#f8538d', '#7d30cb'])
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10)
            ->setLabels(['New Member', 'Renewal Member', 'Come Back']);
    }
}
