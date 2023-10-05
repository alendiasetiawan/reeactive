<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Member Dashboard',
        ];

        return view('member.member_dashboard', $data);
    }
}
