<?php

namespace App\Http\Controllers\Member;

use App\Models\Batch;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RenewalRegistrationController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Renewal Registration',
            'batchOpen' => Batch::where('batch_status', 'Open')->count(),
            'checkBatch' => Batch::checkRegisteredBatch(),
            'isRegisteredInReguler' => Registration::where('member_code', Auth::user()->email)->exists(),
        ];

        return view('member.member_area.renewal_registration', $data);
    }

    public function show($id) {

        $data = [
            'title' => 'Detail Data Pendaftaran',
            'detail' => Registration::showRegistrationDetail($id)
        ];

        return view('member.member_area.registration_detail', $data);
    }
}
