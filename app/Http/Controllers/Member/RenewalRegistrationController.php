<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RenewalRegistrationController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Form Renewal Registration',
        ];

        return view('member.renewal_registration', $data);
    }
}
