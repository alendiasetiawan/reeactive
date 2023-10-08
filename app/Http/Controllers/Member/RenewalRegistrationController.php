<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Registration;
use Illuminate\Http\Request;

class RenewalRegistrationController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Renewal Registration',
            'batchOpen' => Batch::where('batch_status', 'Open')->count(),
            'checkBatch' => Batch::checkRegisteredBatch(),
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
