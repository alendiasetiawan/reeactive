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
                <form wire:submit='register'>
                    {{-- Step 1 : Medical History Check --}}
                    @if ($currentStep == 1)
                        <div class="card mx-auto mb-3">
                            <div class="card-header">
                                <h4>Cek Riwayat Kesehatan</h4>
                                <small>Langkah 1/4</small>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2 mb-2">
                                    <div class="col-12">
                                        <x-inputs.label>Apakah anda dalam kondisi Postpartum (Pasca Melahirkan)?</x-inputs.label>
                                        <br>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="jawaban-satu" name="pertanyaan-satu" value="Iya" wire:model.live='questionOne'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="jawaban-satu" >Iya</x-slot>
                                        </x-inputs.radio-primary>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="jawaban-dua" name="pertanyaan-satu" value="Tidak" wire:model.live='questionOne'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="jawaban-dua">Tidak</x-slot>
                                        </x-inputs.radio-primary>
                                    </div>
                                </div>
                                @if ($questionOne == 'Iya')
                                <div class="row mt-2 mb-2">
                                    <div class="col-12">
                                        <x-inputs.label>Metode melahirkan?</x-inputs.label>
                                        <br>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="pertanyaan-dua-jawaban-satu" name="pertanyaan-dua" value="Normal" wire:model.live='questionTwo'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="pertanyaan-dua-jawaban-satu">Normal</x-slot>
                                        </x-inputs.radio-primary>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="pertanyaan-dua-jawaban-dua" name="pertanyaan-dua" value="Caesar" wire:model.live='questionTwo'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="pertanyaan-dua-jawaban-dua">Caesar</x-slot>
                                        </x-inputs.radio-primary>
                                    </div>
                                </div>
                                @endif
                                @if ($questionTwo == 'Normal')
                                <div class="row mt-2 mb-2">
                                    <div class="col-12">
                                        <x-inputs.label>Jarak waktu melahirkan?</x-inputs.label>
                                        <br>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="pertanyaan-tiga-jawaban-satu" name="pertanyaan-tiga" value="Less" wire:model.live='questionThree'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="pertanyaan-tiga-jawaban-satu">Kurang dari 1.5 bulan</x-slot>
                                        </x-inputs.radio-primary>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="pertanyaan-tiga-jawaban-dua" name="pertanyaan-tiga" value="More" wire:model.live='questionThree'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="pertanyaan-tiga-jawaban-dua">Lebih dari 1.5 bulan</x-slot>
                                        </x-inputs.radio-primary>
                                    </div>
                                </div>
                                @endif
                                {{-- Alert Close Registration --}}
                                @if ($closeRegistration)
                                <div class="row mt-2 mb-2">
                                    <div class="col-12">
                                        <span><b>Mohon maaf, dengan pertimbangan kondisi di atas maka anda <em class="text-danger">belum bisa mengikuti program</em></b></span>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    @endif

                    {{-- Step 2 --}}
                    @if ($currentStep == 2)
                        <div class="card mx-auto mb-3">
                            <div class="card-header">
                                <h4>Akad Program <b class="text-primary">Large Group</b></h4>
                                <small>Langkah 2/4</small>
                            </div>
                            <div class="card-body">
                                <span>Sebelum anda mengisi formulir, pastikan anda telah <b class="text-primary">membaca dan memahami</b> poin-poin akad di bawah ini. <br><br>Berikan tanda <b class="text-primary"><em>Checklist</em></b> jika anda telah paham dan setuju dengan setiap poin dalam akad!</span>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-satu" wire:model='poinSatu'>
                                                <label class="form-check-label" for="poin-satu">
                                                    Pembelian paket (30 sesi) berlaku selama <b>2,5 bulan</b> masa training
                                                </label>
                                                <small class="text-danger"><b>@error('poinSatu') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-dua" wire:model='poinDua'>
                                                <label class="form-check-label" for="poin-dua">
                                                    Refund berlaku jika terjadi : a. <b>Sakit</b> (perlu pengobatan Lebih lanjut), b. <b>Meninggal</b>
                                                </label>
                                                <small class="text-danger"><b>@error('poinDua') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-tiga" wire:model='poinTiga'>
                                                <label class="form-check-label" for="poin-tiga">
                                                    Jadwal latihan dibuat teratur sesuai dengan pilihan member di awal pendaftaran. Perpindahan jadwal latihan hanya diperbolehkan di jadwal coach yang sama, <b>tidak diperkenankan pindah ke kelas coach lain.</b>
                                                </label>
                                                <small class="text-danger"><b>@error('poinTiga') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-empat" wire:model='poinEmpat'>
                                                <label class="form-check-label" for="poin-empat">
                                                    Paket yang sudah dibeli tidak bisa di-pending (cuti) atau di kembalikan
                                                </label>
                                                <small class="text-danger"><b>@error('poinEmpat') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-lima" wire:model='poinLima'>
                                                <label class="form-check-label" for="poin-lima">
                                                    Paket yang sudah dibeli tidak bisa dipindahtangankan kepihak lain
                                                </label>
                                                <small class="text-danger"><b>@error('poinLima') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-enam" wire:model='poinEnam'>
                                                <label class="form-check-label" for="poin-enam">
                                                    Tidak ada sesi pengganti apabila member berhalangan hadir. Tidak pula disediakan rekaman sesi training demi menjaga tersebarnya aurat sesama member & coach.
                                                </label>
                                                <small class="text-danger"><b>@error('poinEnam') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                    </div>
                                <p>
                                    Semoga Allah mengganjar pahala sesuai dengan apa yang diniatkan, melancarkan prosesnya dan memudahkan member untuk istiqomah dalam menjalani keseluruhan program. <em>Allahumma aamiin</em>.
                                </p>
                                <hr/>
                                <span><b><em>Setelah anda memahami ketentuan di atas, silahkan lakukan pembayaran sesuai program yang anda pilih</em></b></span>
                                <details>
                                    <summary style="list-style-type: disclosure-open">Rekening Pembayaran</summary>
                                    <p>
                                        Bank : <b class="text-primary">Muamalat</b> <br>
                                        Rekening : <b class="text-primary">11300-11061</b> <br>
                                        Nama : <b class="text-primary">Khairino Firman Baisya</b> <br>
                                        Kode Bank : <b class="text-primary">147</b>
                                    </p>
                                </details>
                            </div>
                        </div>
                    @endif

                    {{-- Step 3 --}}
                    @if ($currentStep == 3)
                        <div class="card mx-auto mb-3">
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
                                        <small class="text-danger">@error('selectedProgram') {{ $message }} @enderror</small>
                                    </div>
                                    @if ($selectedProgram)
                                        <div class="col-lg-6 col-12">
                                            <x-inputs.label>Coach</x-inputs.label>
                                            <x-inputs.select wire:model.live='selectedCoach'>
                                                <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                                                @foreach ($this->coaches as $coach)
                                                    <x-inputs.select-option value="{{ $coach->code }}">Coach {{ $coach->nick_name }}({{ $coach->coach_name }})</x-inputs.select-option>
                                                @endforeach
                                            </x-inputs.select>
                                            <small class="text-danger">@error('selectedCoach') {{ $message }} @enderror</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Action Button --}}
                    <div class="action-button">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-12">
                                @if ($currentStep > 1)
                                <x-buttons.icon-dark type="button" wire:click='decreaseStep'>
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                    </x-slot>
                                    Kembali
                                </x-buttons.icon-dark>
                                @endif

                                @if ($currentStep < $totalSteps)
                                    @if (!$closeRegistration)
                                    <x-buttons.icon-primary type="button" wire:click='increaseStep'>
                                        Lanjut
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                        </x-slot>
                                    </x-buttons.icon-primary>
                                    @endif
                                @endif

                                @if ($currentStep == $totalSteps)
                                <x-buttons.icon-success type="submit">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                    </x-slot>
                                    Kirim
                                </x-buttons.icon-success>
                                @endif

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
