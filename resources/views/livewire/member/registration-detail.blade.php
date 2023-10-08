<div>
    <div class="row layout-top-spacing">
        <div class="col-lg-7 col-md-6 col-12">
            <div class="payment-history layout-spacing">
                <div class="widget-content widget-content-area">
                    <h3 class="">Detail Registrasi</h3>

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Batch</div>
                                        <p class="sub-title mb-0">{{ $detail->batch_name }}</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Program</div>
                                        <p class="sub-title mb-0">{{ $detail->program_name }}</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Level</div>
                                        <p class="sub-title mb-0">{{ $detail->level_name }}</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Coach</div>
                                        <p class="sub-title mb-0">{{ $detail->nick_name }} ({{ $detail->coach_name }})</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Kelas</div>
                                        <p class="sub-title mb-0">
                                            {{ $detail->day }}
                                            ({{ \Carbon\Carbon::parse($detail->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($detail->end_time)->format('H:i') }})
                                        </p>
                                    </div>
                                </div>
                                <div></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="list-group">
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Tanggal Daftar</div>
                                        <p class="sub-title mb-0">{{ $detail->created_at->isoFormat('D MMMM Y') }}</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Jenis Pendaftaran</div>
                                        <p class="sub-title mb-0">{{ $detail->registration_category }}</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Nominal Pembayaran</div>
                                        <p class="sub-title mb-0">{{ 'Rp '.number_format($detail->amount_pay,0,',','.') }}</p>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold title">Status Pembayaran</div>
                                        <p class="sub-title mb-0">
                                            @if ($detail->payment_status == 'Done')
                                                <x-items.badges.light-success>Selesai</x-items.badges.light-success>
                                            @elseif ($detail->payment_status == 'Process')
                                                <x-items.badges.light-warning>Proses</x-items.badges.light-warning>
                                            @else
                                                <x-items.badges.light-danger>Invalid</x-items.badges.light-danger>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lampiran Bukti Transfer</h5>
                    <img src="{{ asset('storage/'.$detail->file_upload) }}" width="100%" height="auto">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-12">
            <x-buttons.outline-dark>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                <span class="btn-text-inner">Kembali</span>
            </x-buttons.outline-dark>
        </div>
    </div>
</div>

