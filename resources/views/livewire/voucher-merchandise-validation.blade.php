<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        <span class="text-secondary">Home</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Validasi Voucher</li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
        <div class="d-flex align-items-center justify-content-center mt-3 mb-5">
            <div class="col-lg-8 col-12">
                <div class="card mx-auto">
                    <div class="card-header">
                        Validasi Voucher Merchandise
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-4 text-center">
                                <img src="{{ asset('/voucher.png') }}" width="100%" height="auto"/>
                            </div>
                        </div>
                        @if ($isCodeExists)
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <h3>ID #{{ $voucher->qr_code }}</h3>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Nama Member</x-inputs.label>
                                    <x-inputs.basic value="{{ $voucher->member_name }}"/>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Batch</x-inputs.label>
                                    <x-inputs.basic value="{{ $voucher->batch_name }}"/>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Program</x-inputs.label>
                                    <x-inputs.basic value="{{ $voucher->registration->program_name ?? 'Kosong' }}"/>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Coach</x-inputs.label>
                                    <x-inputs.basic value="{{ $voucher->registration->nick_name }}"/>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Nominal Voucher</x-inputs.label>
                                    <x-inputs.basic value="{{ \App\Helpers\CurrencyHelper::formatRupiah($voucher->merchandise_voucher) }}"/>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Valid Sampai</x-inputs.label>
                                    <x-inputs.basic value="{{ \App\Helpers\TanggalHelper::konversiTanggal($voucher->valid_date) }}"/>
                                </div>
                            </div>
                            <div class="row text-center mt-3">
                                <div class="col-12">
                                    @if ($voucher->is_used == 0)
                                        <x-items.badges.solid-success>Belum Digunakan</x-items.badges.solid-success>
                                    @else
                                        <x-items.badges.solid-danger>Sudah Digunakan Pada {{ \App\Helpers\TanggalHelper::konversiTanggal($voucher->updated_at) }}</x-items.badges.solid-danger>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row text-center mt-3">
                                <div class="col-12">
                                    <x-items.alerts.light-danger>Maaf! Voucher anda tidak valid</x-items.alerts.light-danger>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
