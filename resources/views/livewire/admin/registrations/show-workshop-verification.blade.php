<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('member::renewal_registration') }}">Verifikasi</x-slot>
        <x-slot name="currentPage">Detail Pembayaran Workshop</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <!--Verification Form-->
        <div class="col-lg-8 col-12">
            <div class="widget">
                <div class="w-header layout-spacing">
                    <h5>Detail Pembayaran Workshop</h5>
                </div>
                <div class="w-content">
                    <form wire:submit.prevent="saveData">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mb-3">
                                <x-inputs.label>Nama Lengkap</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $this->paymentDetail->member_name }}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Program</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $this->paymentDetail->program_name }}"></x-inputs.disable-text>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Status Assessment</x-inputs.label>
                                @if ($this->paymentDetail->is_assessment == 1)
                                <x-inputs.disable-text placeholder="Sudah"></x-inputs.disable-text>
                                @else
                                <x-inputs.disable-text placeholder="Belum"></x-inputs.disable-text>
                                @endif
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Kode Voucher</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $this->paymentDetail->vocher_code }}"></x-inputs.disable-text>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Nominal Transfer</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ 'Rp '.number_format($this->paymentDetail->amount_pay,0,',','.') }}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Waktu Upload</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $this->paymentDetail->created_at->isoFormat('LLLL') }}"></x-inputs.disable-text>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Status Transfer : <b class="text-primary">{{ $paymentStatus }}</b></x-inputs.label>
                                <x-inputs.select wire:model.live="paymentStatus" required
                                oninvalid="this.setCustomValidity('Apakah bukti transfer nya valid?')"
                                oninput="this.setCustomValidity('')">
                                    <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                                    <x-inputs.select-option value="Done">Valid</x-inputs.select-option>
                                    <x-inputs.select-option value="Invalid">Tidak Valid</x-inputs.select-option>
                                </x-inputs.select>
                            </div>
                            @if ($showReasonInvalid == true)
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Alasan Invalid</x-inputs.label>
                                <textarea class="form-control" wire:model="invalidReason" rows="3" required
                                oninvalid="this.setCustomValidity('Alasan invalid wajib diisi')"
                                oninput="this.setCustomValidity('')"></textarea>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <x-buttons.solid-primary type="submit">Simpan</x-buttons.solid-primary>
                                <a wire:navigate href="{{ route('admin::workshop_verification') }}">
                                    <x-buttons.outline-dark>Kembali</x-buttons.outline-dark>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--#Verfiication Form-->

        <div class="col-lg-4 col-12">
            <div class="widget">
                <div class="w-header layout-spacing">
                    <h5>Lampiran Bukti Transfer</h5>
                </div>
                <div class="w-conten">
                    <img src="{{ asset('storage/'.$this->paymentDetail->file_upload) }}" width="100%" height="auto">
                </div>
            </div>
        </div>
    </div>
</div>
