<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentVerificationController extends Controller
{
    public function index() {

        $data = [
            'title' => 'Verifikasi Bukti Transfer',
        ];

        return view('admin.finance.payment_verification', $data);
    }
}
