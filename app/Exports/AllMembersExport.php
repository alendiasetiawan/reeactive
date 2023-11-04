<?php

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class AllMembersExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder, WithStyles
{
    protected $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    public function view(): View
    {
        $data = [
            'members' => Registration::join('members', 'registrations.member_code', 'members.code')
            ->join('programs', 'registrations.program_id', 'programs.id')
            ->join('levels', 'registrations.level_id', 'levels.id')
            ->join('coaches', 'registrations.coach_id', 'coaches.id')
            ->join('classes', 'registrations.class_id', 'classes.id')
            ->where('batch_id', $this->batchId)
            ->where('payment_status', 'Done')
            ->select('registrations.*', 'members.*', 'programs.program_name', 'levels.level_name', 'coaches.nick_name', 'classes.day', 'classes.start_time', 'classes.end_time')
            ->orderBy('members.member_name', 'asc')
            ->get()
        ];

        return view('admin.database.all-members-export', $data);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => [
                'bold' => true,
                'size' => 16,
                ]],
        ];
    }
}
