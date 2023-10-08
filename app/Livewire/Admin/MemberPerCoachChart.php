<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class MemberPerCoachChart extends Component
{
    public function render()
    {
        $data = [
            'columnChartModel' => (new ColumnChartModel())->setTitle('Expenses by Type')
            ->addColumn('Food', 100, '#f6ad55')
            ->addColumn('Shopping', 200, '#fc8181')
            ->addColumn('Travel', 300, '#90cdf4'),
        ];

        return view('livewire.admin.member-per-coach-chart', $data);
    }
}
