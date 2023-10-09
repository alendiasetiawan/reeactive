<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use App\Http\Controllers\Controller;

class PaymentVerificationController extends Controller
{
    public function index() {

        $data = [
            'title' => 'Verifikasi Bukti Transfer',
        ];

        return view('admin.finance.payment_verification', $data);
    }
}
