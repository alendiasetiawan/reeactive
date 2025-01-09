<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Detail Transfer</x-slot:title>
        <x-slot:firstPage wire:navigate href="{{ route('admin::payment_verification') }}">Verifikasi Transfer</x-slot:firstPage>
        <x-slot:activePage>Detail Transfer</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <!--Detail Member-->
        <div class="col-lg-7 col-md-6 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Data Member <b class="text-primary" wire:ignore>{{ $paymentDetail->batch_name }}</b></x-slot:cardTitle>
                <div class="row" wire:ignore>
                    <small class="text-muted">Member Sejak : {{ $firstBatchName }}</small>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Jenis Registrasi</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $paymentDetail->registration_category }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Tipe Registrasi</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $paymentDetail->registration_type }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Nama Member</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $paymentDetail->member_name }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Program</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $paymentDetail->program_name }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Coach</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $paymentDetail->coach_name }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Kelas</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $paymentDetail->day }} ({{ \Carbon\Carbon::parse($paymentDetail->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($paymentDetail->end_time)->format('H:i') }})" disabled/>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
        <!--#Detail Member-->

        <!--Detail Payment-->
        <div class="col-lg-5 col-md-6 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Data Transfer</x-slot:cardTitle>
                <form wire:submit.prevent="saveData">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-1">
                            <x-inputs.label>Nominal Transfer</x-inputs.label>
                            <x-inputs.vuexy-basic value="{{ 'Rp '.number_format($paymentDetail->amount_pay,0,',','.') }}" disabled/>
                            <small class="text-muted">
                                Biaya Program : {{ \App\Helpers\CurrencyHelper::formatRupiah($paymentDetail->program_price) }}
                                <br/>
                                Admin Fee : {{ \App\Helpers\CurrencyHelper::formatRupiah($paymentDetail->admin_fee) }}
                                <br/>
                                @if ($isDiscountApply)
                                    Diskon : (-{{ \App\Helpers\CurrencyHelper::formatRupiah($amountDisc) }})
                                    <br/>
                                    Jenis Diskon : {{ $discountType }}
                                @endif
                            </small>
                        </div>
                        <div class="col-lg-6 col-12 mb-1">
                            <x-inputs.label>Waktu Upload</x-inputs.label>
                            <x-inputs.vuexy-basic value="{{ $paymentDetail->created_at->isoFormat('lll') }}" disabled/>
                        </div>
                        <div class="col-12 mb-1">
                            <x-inputs.label>
                                Bukti Transfer
                                @if ($paymentStatus == 'Done')
                                    <x-badges.basic color="success">Valid</x-badges.basic>
                                @elseif ($paymentStatus == 'Process')
                                    <x-badges.basic color="warning">Proses</x-badges.basic>
                                @elseif ($paymentStatus == 'Follow Up')
                                    <x-badges.basic color="info">Follow Up</x-badges.basic>
                                @else
                                    <x-badges.basic color="danger">Invalid</x-badges.basic>
                                @endif
                            </x-inputs.label>
                            <img src="{{ asset('storage/'.$paymentDetail->file_upload) }}" width="100%" height="auto">
                        </div>
                        <div class="col-12 mb-1">
                            <x-inputs.label>Status Transfer</x-inputs.label>
                            <x-inputs.vuexy-select wire:model.live='paymentStatus'>
                                <x-inputs.vuexy-select-option value="Process">Proses</x-inputs.vuexy-select-option>
                                <x-inputs.vuexy-select-option value="Done">Valid</x-inputs.vuexy-select-option>
                                <x-inputs.vuexy-select-option value="Invalid">Invalid</x-inputs.vuexy-select-option>
                                <x-inputs.vuexy-select-option value="Follow Up">Follow Up</x-inputs.vuexy-select-option>
                            </x-inputs.vuexy-select>
                        </div>
                        <div class="col-12 mb-1">
                            <x-inputs.label>Catatan (Opsional)</x-inputs.label>
                            <textarea wire:model='note' class="form-control" rows="3" placeholder="Tulis catatan khusus untuk pembayaran ini"></textarea>
                        </div>
                        @if ($showReasonInvalid)
                            <div class="col-12 mb-1">
                                <x-inputs.label>Alasan Invalid</x-inputs.label>
                                <textarea wire:model.live.debounce.250ms='invalidReason' class="form-control" rows="3"></textarea>
                            </div>
                        @endif
                        <div class="col-12">
                            <x-buttons.basic color="primary" type="submit" :disabled="!$errors->any() ? false : true">Simpan</x-buttons.basic>
                            <a href="{{ route('admin::payment_verification') }}" wire:navigate>
                                <x-buttons.outline-dark type="button">Kembali</x-buttons.outline-dark>
                            </a>
                        </div>
                    </div>
                </form>
            </x-cards.basic-card>
        </div>
        <!--#Detail Payment-->
    </div>
</div>
