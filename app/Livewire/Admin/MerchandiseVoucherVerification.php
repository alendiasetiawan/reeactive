<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\BatchService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\VoucherMerchandise;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class MerchandiseVoucherVerification extends Component
{
    #[Title('Verifikasi Voucher Merchandise')]
    #[Layout('layouts.app')]

    //Object
    public $lastBatches;
    //Integer
    public $selectedBatch, $limitData = 9;
    //String
    public $linkVoucher, $searchMember = null;
    //Boolean
    public $isResetFilter = false;

    //HOOK - Execute once when component rendered
    public function mount(BatchService $batchService) {
        $this->lastBatches = $batchService->getLastBatch();
        $this->selectedBatch = $batchService->batchIdActive();
    }

    public function updated() {
        $this->isResetFilter = true;
    }

    //PROPERTY - Get list of active vouchers in current batch
    #[Computed]
    public function listVouchers() {
        return VoucherMerchandise::getListOfVouchers($this->selectedBatch, $this->limitData, $this->searchMember);
    }

    #[Computed]
    public function countVoucher() {
        return VoucherMerchandise::where('batch_id', $this->selectedBatch)->count();
    }

    #[Computed]
    public function voucherUsed() {
        return VoucherMerchandise::where('batch_id', $this->selectedBatch)->where('is_used', 1)->count();
    }

    #[Computed]
    public function voucherNotUsed() {
        return $this->countVoucher - $this->voucherUsed;
    }

    //ONCLICK - Set status voucher used or not
    public function useVoucher($id) {
        try {
            $realId = Crypt::decrypt($id);
            $dataVoucher = VoucherMerchandise::find($realId);
            $dataVoucher->is_used == 1 ? $status = 0 : $status = 1;

            VoucherMerchandise::where('id', $realId)->update([
                'is_used' => $status
            ]);
        } catch (DecryptException) {
            session()->flash('error-id', 'Stop! Dilarang melakukan modifikasi ID Paramater');
        }
    }

    //ONCLICK - Load more data
    public function loadMore() {
        $this->limitData += 9;
    }

    public function render()
    {
        return view('livewire.admin.merchandise-voucher-verification');
    }
}
