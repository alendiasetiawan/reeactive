<div>
    @push('customCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/src/stepper/bsStepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/scrollspyNav.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/css/light/stepper/custom-bsStepper.css') }}">
    @endpush
    {{-- The best athlete wants his opponent at his best. --}}

    <x-items.breadcrumb>
        <x-slot name="mainPage">Beranda</x-slot>
        <x-slot name="currentPage">New Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="d-flex align-items-center justify-content-center">
            <h2>Pendaftaran New Member Reeactive <b class="text-primary">{{ $batch->batch_name }}</b></h2>
        </div>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <div class="col-lg-7">
                <form>
                    {{-- Step 1 --}}
                    <div class="step-one">
                        <div class="card mx-auto mb-5">
                            <div class="card-header">
                                <h4>Akad Program <b class="text-primary">Large Group</b></h4>
                                <small>Langkah 1/4</small>
                            </div>
                            <div class="card-body">
                                <p>Sebelum anda mengisi formulir, pastikan anda telah <b class="text-primary">membaca dan memahami</b> poin-poin dalam akad di bawah ini. Berikan tanda <b class="text-primary"><em>Checklist</em></b> jika anda telah memahami setiap poin dalam akad!</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-satu">
                                                <label class="form-check-label" for="poin-satu">
                                                    Pembelian paket (30 sesi) berlaku selama <b>2,5 bulan</b> masa training
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-dua">
                                                <label class="form-check-label" for="poin-dua">
                                                    Refund berlaku jika terjadi : a. <b>Sakit</b> (perlu pengobatan Lebih lanjut), b. <b>Meninggal</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-tiga">
                                                <label class="form-check-label" for="poin-tiga">
                                                    Jadwal latihan dibuat teratur sesuai dengan pilihan member di awal pendaftaran. Perpindahan jadwal latihan hanya diperbolehkan di jadwal coach yang sama, <b>tidak diperkenankan pindah ke kelas coach lain.</b>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-empat">
                                                <label class="form-check-label" for="poin-empat">
                                                    Paket yang sudah dibeli tidak bisa di-pending (cuti) atau di kembalikan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-lima">
                                                <label class="form-check-label" for="poin-lima">
                                                    Paket yang sudah dibeli tidak bisa dipindahtangankan kepihak lain
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-enam">
                                                <label class="form-check-label" for="poin-enam">
                                                    Tidak ada sesi pengganti apabila member berhalangan hadir. Tidak pula disediakan rekaman sesi training demi menjaga tersebarnya aurat sesama member & coach.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <p>
                                    Semoga Allah mengganjar pahala sesuai dengan apa yang diniatkan, melancarkan prosesnya dan memudahkan member untuk istiqomah dalam menjalani keseluruhan program. <em>Allahumma aamiin</em>,
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Step 2 --}}
                    <div class="step-two">
                        <div class="card mx-auto mb-5">
                            <div class="card-header">
                                <h4>Pilih Program</h4>
                                <small>Langkah 2/4</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <x-inputs.label>Program</x-inputs.label>
                                        <x-inputs.select wire:model.live='selectedProgram'>
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @foreach ($programs as $program)
                                                <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>
                                    @if ($selectedProgram)
                                        <div class="col-lg-6 col-12">
                                            <x-inputs.label>Coach</x-inputs.label>
                                            <x-inputs.select wire:model.live='selectedCoach'>
                                                <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                                                @foreach ($this->coaches as $coach)
                                                    <x-inputs.select-option value="{{ $coach->code }}">Coach {{ $coach->nick_name }}({{ $coach->coach_name }})</x-inputs.select-option>
                                                @endforeach
                                            </x-inputs.select-option>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-button">
                        <div class="card mx-auto mb-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <x-buttons.solid-dark>Sebelumnya</x-buttons.solid-dark>
                                        <x-buttons.solid-success>Berikutnya</x-buttons.solid-success>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
