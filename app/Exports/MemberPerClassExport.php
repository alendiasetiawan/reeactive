<?php

namespace App\Exports;

use App\Models\Batch;
use App\Models\ClassModel;
use App\Models\Coach;
use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;


class MemberPerClassExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder, WithStyles
{

    public function __construct($coachId, $classId, $batchId)
    {
        $this->coachId = $coachId;
        $this->classId = $classId;
        $this->batchId = $batchId;
    }
    public function view(): View
    {
        $coach = Coach::find($this->coachId);
        $batch = Batch::find($this->batchId);

        $data = [
            'members' => Registration::join('members', 'registrations.member_code', 'members.code')
            ->join('programs', 'registrations.program_id', 'programs.id')
            ->join('levels', 'registrations.level_id', 'levels.id')
            ->join('coaches', 'registrations.coach_id', 'coaches.id')
            ->join('classes', 'registrations.class_id', 'classes.id')
            ->where('batch_id', $this->batchId)
            ->where('coach_id', $this->coachId)
            ->where('class_id', $this->classId)
            ->where('payment_status', 'Done')
            ->select('registrations.*', 'members.*', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'classes.day', 'classes.start_time', 'classes.end_time')
            ->orderBy('members.member_name', 'asc')
            ->get(),
            'coachName' => $coach->coach_name,
            'coachNick' => $coach->nick_name,
            'batchName' => $batch->batch_name,
            'classQuery' => ClassModel::find($this->classId),
        ];

        return view('admin.database.member_per_class_export', $data);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
                'font' => [
                    'bold' => true,
                    'size' => 18
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ]
            ],
            2    => ['font' => ['bold' => true]],
        ];
    }
}
