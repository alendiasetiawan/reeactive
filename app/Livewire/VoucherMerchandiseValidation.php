<?php

namespace App\Livewire;

use App\Models\VoucherMerchandise;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class VoucherMerchandiseValidation extends Component
{
    //Object
    public $voucher;
    //Bool
    public $isCodeExists;

    #[Title('Validasi Voucher Merchandise')]
    #[Layout('layouts.blank')]

    public function mount($code) {
        //Check if id exists
        $this->isCodeExists = VoucherMerchandise::where('qr_code', $code)->exists();

        if ($this->isCodeExists) {
            $this->voucher = VoucherMerchandise::getOneVoucher($code);
        }
    }

    public function render()
    {
        return view('livewire.voucher-merchandise-validation');
    }
}
