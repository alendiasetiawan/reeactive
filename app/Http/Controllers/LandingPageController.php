<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Online Coaching Untuk Muslimah',
            'privatePrograms' => Program::privatePrograms(),
            'buddyPrograms' => Program::buddyPrograms(),
            'smallPrograms' => Program::smallPrograms(),
            'specialPrograms' => Program::specialPrograms(),
            'largePrograms' => Program::largePrograms(),
            'nutrionPrograms' => Program::nutrionPrograms(),
        ];

        return view('welcome', $data);
    }
}
