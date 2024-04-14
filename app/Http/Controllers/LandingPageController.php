<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Services\BatchService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(BatchService $batchService) {
        $batchQuery = $batchService->batchQuery();
        $data = [
            'title' => 'Online Coaching Untuk Muslimah',
            'batch' => $batchQuery,
            'privatePrograms' => Program::privatePrograms(),
            'buddyPrograms' => Program::buddyPrograms(),
            'smallPrograms' => Program::smallPrograms(),
            'specialPrograms' => Program::specialPrograms(),
            'largePrograms' => Program::largePrograms(),
            'nutrionPrograms' => Program::nutrionPrograms(),
            'openDate' => $batchQuery->start_date,
        ];

        return view('welcome', $data);
    }
}
