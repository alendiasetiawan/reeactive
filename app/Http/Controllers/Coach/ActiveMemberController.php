<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActiveMemberController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Dashboard Coach',
        ];

        return view('dashboard_coach', $data);
    }
}
