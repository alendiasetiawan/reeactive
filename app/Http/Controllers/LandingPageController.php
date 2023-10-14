<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Services\BatchService;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(BatchService $batchService) {
        $data = [
            'title' => 'Online Coaching Untuk Muslimah',
            'batch' => $batchService->batchQuery(),
            'privatePrograms' => Program::privatePrograms(),
            'buddyPrograms' => Program::buddyPrograms(),
            'smallPrograms' => Program::smallPrograms(),
            'specialPrograms' => Program::specialPrograms(),
            'largePrograms' => Program::largePrograms(),
            'nutrionPrograms' => Program::nutrionPrograms(),
            'openDate' => '2023-10-15 09:00:00'
        ];

        return view('welcome', $data);
    }
}
