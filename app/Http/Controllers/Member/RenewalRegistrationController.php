<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class RenewalRegistrationController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Form Renewal Registration',
            'batchOpen' => Batch::where('batch_status', 'Open')->count(),
            'checkBatch' => Batch::checkRegisteredBatch(),
        ];

        return view('member.member_area.renewal_registration', $data);
    }
}
