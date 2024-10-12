<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\BatchService;
use App\Helpers\CurrencyHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\VoucherMerchandise;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Contracts\Encryption\DecryptException;

class DownloadVoucherMerchandise extends Controller
{
    public function create($id) {
        try {
            $realId = Crypt::decrypt($id);
        } catch (DecryptException) {
            // session()->flash('error-id', 'Stop! Anda dilarang melakukan modifikasi ID Parameter');
            return redirect(route('member::dashboard'))->with('error-id', 'Stop! Anda dilarang melakukan modifikasi ID Parameter');
        }

        $batchService = new BatchService();
        $batch = $batchService->batchQuery();

        //Check if code is exists
        $voucher = VoucherMerchandise::findOrFail($realId);
        $qrCode = $voucher->qr_code;

        $url = url('validasi-voucher-merchandise/'.$qrCode);

        $data = [
            'title' => '['.$batch->batch_name.'] Voucher Merchandise Reeactive',
            'qr' => base64_encode(QrCode::format('svg')->size(150)->errorCorrection('H')->generate($url)),
            'voucherAmount' => CurrencyHelper::formatRupiah($batch->merchandise_voucher),
            'validDate' => Carbon::parse($voucher->valid_date)->isoFormat('D MMM Y'),
            'batchName' => $batch->batch_name,
        ];

        $pdf = Pdf::loadView('member.voucher-merchandise', $data)->setPaper('A6', 'landscape');
        return $pdf->download('('.$batch->batch_name.') Voucher Merchandise Reeactive.pdf');
    }
}
