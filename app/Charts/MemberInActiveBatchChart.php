<?php

namespace App\Charts;

use App\Models\Batch;
use App\Models\Coach;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MemberInActiveBatchChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($batchId)
    {
        $coaches = Coach::orderBy('coach_name', 'asc')
        ->select('id', 'coach_name', 'nick_name')
        ->pluck('nick_name')
        ->toArray();

        $members = Coach::with([
            'registrations' => function ($query) use($batchId) {
                $query->where('batch_id', $batchId);
            }
        ])
        ->select('id', 'coach_name', 'nick_name')
        ->orderBy('coach_name', 'asc')
        ->get();

        foreach($members as $member) {
            $countMember[] = $member->registrations->count();
        }

        return $this->chart->barChart()
        ->addData('Jumlah Member', $countMember)
        ->setColors(['#22c7d5'])
        ->setHeight(280)
        ->setGrid()
        ->setMarkers(['#FF5722', '#E040FB'], 5, 8)
        ->setXAxis($coaches);
    }
}
