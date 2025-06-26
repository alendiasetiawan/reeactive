<div>
    @push('customCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/scrollspyNav.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link href="{{ asset('template/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    @endpush
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        <span class="text-secondary">Halaman Utama</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">New Member</li>
            </ol>
        </nav>
    </div>

    @if (\Carbon\Carbon::now() >= $openDate)
        @if ($batch->batch_status == 'Open' || $privateBatch->status == 'Open')
        <div class="row layout-top-spacing">
            <div class="d-flex align-items-center justify-content-center">
                <h2>Pendaftaran New Member Reeactive</h2>
            </div>
            @if ($currentStep <= 2)
            <div class="d-flex align-items-center justify-content-center">
                <b class="text-info">"Info rekening pembayaran akan muncul setelah anda memilih program dan coach"</b>
            </div>
            @endif

            @if (session('failed'))
            <div class="d-flex align-items-center justify-content-center">
                <x-items.alerts.light-danger>
                    {{ session('failed') }}
                </x-items.alerts.light-danger>
            </div>
            @endif

            @if (session('fullQuota'))
            <div class="d-flex align-items-center justify-content-center">
                <x-items.alerts.light-danger>
                    {{ session('fullQuota') }}
                </x-items.alerts.light-danger>
            </div>
            @endif

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
                                        <div class="col-lg-6 col-12">
                                            <x-inputs.label>
                                                Kode Referral
                                                @if ($referralCode != null)
                                                    <x-items.badges.solid-danger wire:click='clearReferralCode'>Hapus</x-items.badges.solid-danger>
                                                @endif
                                            </x-inputs.label>
                                            <x-inputs.basic wire:model.live.debounce.350ms='referralCode' placeholder="Tulis jika anda memiliki kode"/>
                                            @if ($referralCode != null)
                                                <!--Logic for Reguler Referral Code-->
                                                @if ($regulerReferralFound)
                                                    @if (!$isRegisteredEarly && ($countReferralUsed < $referralLimit))
                                                        <small class="text-success">Selamat! Anda Mendapatkan Diskon Pendaftaran Sebesar {{ CurrencyHelper::formatRupiah($discountReferral) }}</small>
                                                    @elseif ($isRegisteredEarly)
                                                        <small class="text-danger">Maaf, Kode Referral Sudah Tidak Berlaku</small>
                                                    @else
                                                        <small class="text-danger">Maaf, Kode Tidak Bisa Digunakan Lebih Dari {{ $referralLimit }}x</small>
                                                    @endif
                                                @endif
                                                <!--#Logic for Reguler Referral Code-->

                                                <!--Logic for Influencer Referral Code-->
                                                @if ($influencerReferralFound)
                                                    @if ($isReferralInfluencerExpired)
                                                        <small class="text-danger">Maaf, Kode Referral Sudah Tidak Berlaku</small>
                                                    @elseif ($countReferralInfluencerUsed >= $influencerReferralLimit)
                                                        <small class="text-danger">Maaf, Kode Tidak Bisa Digunakan Lebih Dari {{ $influencerReferralLimit }}x</small>
                                                    @else
                                                        <small class="text-success">Selamat! Anda Mendapatkan Diskon Pendaftaran Sebesar {{ CurrencyHelper::formatRupiah($discountReferral) }}</small>
                                                    @endif
                                                @endif
                                                <!--#Logic for Influencer Referral Code-->

                                                @if (!$regulerReferralFound && !$influencerReferralFound)
                                                    <small class="text-danger">Maaf! Kode Referral Tidak Valid</small>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-2">
                                        <div class="col-12">
                                            <span class="text-muted">Silahkan isi pertanyaan di bawah ini</span>
                                            <br/>
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
                                            <x-inputs.label>Jarak waktu melahirkan normal?</x-inputs.label>
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

                                    @if ($questionThree == 'More')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <x-inputs.label>Apakah anda memiliki <em>Diastasis Recti</em>?
                                            <a href="https://hellosehat.com/kehamilan/melahirkan/diastasis-recti-perut-tak-kempes/" target="_blank">
                                                <small class="text-info">(Apa itu Diastasis Recti? Baca Disini!)</small>
                                            </a>
                                            </x-inputs.label>
                                            <br>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-empat-jawaban-satu" name="pertanyaan-empat" value="Iya" wire:model.live='questionFour'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-empat-jawaban-satu">Iya</x-slot>
                                            </x-inputs.radio-primary>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-empat-jawaban-dua" name="pertanyaan-empat" value="Tidak" wire:model.live='questionFour'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-empat-jawaban-dua">Tidak</x-slot>
                                            </x-inputs.radio-primary>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($questionTwo == 'Caesar')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <x-inputs.label>Jarak waktu melahirkan Caesar?</x-inputs.label>
                                            <br>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-lima-jawaban-satu" name="pertanyaan-lima" value="Less" wire:model.live='questionFive'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-lima-jawaban-satu">Kurang dari 3 bulan</x-slot>
                                            </x-inputs.radio-primary>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-lima-jawaban-dua" name="pertanyaan-lima" value="More" wire:model.live='questionFive'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-lima-jawaban-dua">Lebih dari 3 bulan</x-slot>
                                            </x-inputs.radio-primary>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($questionFive == 'More')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <x-inputs.label>Apakah anda memiliki <em>Diastasis Recti</em>?
                                            <a href="https://hellosehat.com/kehamilan/melahirkan/diastasis-recti-perut-tak-kempes/" target="_blank">
                                                <small class="text-info">(Apa itu Diastasis Recti? Baca Disini!)</small>
                                            </a>
                                            </x-inputs.label>
                                            <br>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-enam-jawaban-satu" name="pertanyaan-enam" value="Iya" wire:model.live='questionSix'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-enam-jawaban-satu">Iya</x-slot>
                                            </x-inputs.radio-primary>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-enam-jawaban-dua" name="pertanyaan-enam" value="Tidak" wire:model.live='questionSix'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-enam-jawaban-dua">Tidak</x-slot>
                                            </x-inputs.radio-primary>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($questionSpecialCase)
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <x-inputs.label>Apakah anda memiliki kondisi khusus?</x-inputs.label>
                                            <br>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-tujuh-jawaban-satu" name="pertanyaan-tujuh" value="Iya" wire:model.live='questionSeven'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-tujuh-jawaban-satu">Iya</x-slot>
                                            </x-inputs.radio-primary>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-tujuh-jawaban-dua" name="pertanyaan-tujuh" value="Tidak" wire:model.live='questionSeven'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-tujuh-jawaban-dua">Tidak</x-slot>
                                            </x-inputs.radio-primary>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($questionSeven == 'Iya')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <x-inputs.label>Kondisi khusus apa yang anda miliki?</x-inputs.label>
                                            <br>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-delapan-jawaban-satu" name="pertanyaan-delapan" value="Cardiovascular" wire:model.live='questionEight'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-delapan-jawaban-satu">Cardiovascular</x-slot>
                                            </x-inputs.radio-primary>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-delapan-jawaban-dua" name="pertanyaan-delapan" value="Cidera" wire:model.live='questionEight'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-delapan-jawaban-dua">Riwayat Cidera</x-slot>
                                            </x-inputs.radio-primary>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($questionEight == 'Cidera')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <x-inputs.label>Cidera apa yang anda alami?</x-inputs.label>
                                            <br>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-sembilan-jawaban-satu" name="pertanyaan-sembilan" value="Spinal Culvature" wire:model.live='questionNine'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-sembilan-jawaban-satu">Spinal Culvature (Skoliosis, Lordosis, Kyposis)</x-slot>
                                            </x-inputs.radio-primary>
                                            <x-inputs.radio-primary>
                                                <x-inputs.check-radio id="pertanyaan-sembilan-jawaban-dua" name="pertanyaan-sembilan" value="Otot Tulang Sendi" wire:model.live='questionNine'></x-inputs.check-radio>
                                                <x-slot name="labelRadio" for="pertanyaan-sembilan-jawaban-dua">Otot Tulang Sendi</x-slot>
                                            </x-inputs.radio-primary>
                                        </div>
                                    </div>
                                    @endif

                                    {{-- Alert Close Registration --}}
                                    @if ($questionThree == 'Less' || $questionFive == 'Less')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <span><b>Mohon maaf, dengan pertimbangan kondisi di atas maka anda <em class="text-danger">belum bisa mengikuti program</em></b></span>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($questionFour == 'Iya' || $questionSix == 'Iya')
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <span><b>Mohon maaf, kami sarankan sebaiknya anda <em class="text-danger">datang ke fisioterapi</em> terlebih dahulu sebelum bisa mengikuti program</span>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        @endif

                        {{-- Step 2: Terms and Condition --}}
                        @if ($currentStep == 2)
                            <div class="card mx-auto mb-3">
                                <div class="card-header">
                                    <h4>Akad Program</h4>
                                    <small>Langkah 2/4</small>
                                </div>
                                <div class="card-body">
                                    <span>Sebelum anda mengisi formulir, pastikan anda telah <b class="text-primary">membaca dan memahami</b> poin-poin akad di bawah ini. <br><br>Berikan tanda <b class="text-primary"><em>Checklist</em></b> jika anda telah paham dan setuju dengan setiap poin dalam akad!</span>
                                        <div class="row mt-2 mb-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-primary form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="poin-satu" wire:model='poinSatu'>
                                                    <label class="form-check-label" for="poin-satu">
                                                        <b>Program Large Group</b> : Pembelian paket (30 sesi) berlaku selama <b>2,5 bulan</b> masa training |
                                                        <b>Program Small Group</b> : Pembelian paket (10 Sesi)
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
                                </div>
                            </div>
                        @endif

                        {{-- Step 3: Choose Program --}}
                        @if ($currentStep == 3)
                            <div class="card mx-auto mb-3">
                                <div class="card-header">
                                    <h4>Pilih Program</h4>
                                    <small>Langkah 3/4</small>
                                </div>
                                <div class="card-body">
                                    @if ($specialCase)
                                    <p class="text-center">
                                        Kondisi Khusus : <em class="text-primary">{{ $medical_condition }}</em>
                                    </p>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <x-inputs.label>Program</x-inputs.label>
                                            <x-inputs.select wire:model.live='selectedProgram'>
                                                <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                                @if ($medical_condition == 'Cardiovascular')
                                                    <x-inputs.select-option value="4">Special Case Small Group</x-inputs.select-option>
                                                @elseif ($medical_condition == 'Otot Tulang Sendi' || $medical_condition == 'Spinal Culvature')
                                                    <x-inputs.select-option value="{{ $specialProgram->id }}">{{ $specialProgram->program_name }}</x-inputs.select-option>
                                                @else
                                                    @foreach ($this->programs as $program)
                                                        <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                                                    @endforeach
                                                @endif
                                            </x-inputs.select>
                                            <small class="text-danger">@error('selectedProgram') {{ $message }} @enderror</small>
                                        </div>

                                        {{-- @if ($selectedProgram) --}}
                                            <div class="col-lg-6 col-12 mb-3">
                                                <x-inputs.label>Coach</x-inputs.label>
                                                <x-inputs.select wire:model.live='selectedCoach'>
                                                    <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                                                    @if ($questionEight == 'Cardiovascular')
                                                        <x-inputs.select-option value="87825749786">Coach Mega (Mega Maharani)</x-inputs.select-option>
                                                    @elseif ($questionNine == 'Spinal Culvature')
                                                        <x-inputs.select-option value="8979034958">Coach Mala (Mala Damayanti)</x-inputs.select-option>
                                                    @elseif ($questionNine == 'Otot Tulang Sendi')
                                                        <x-inputs.select-option value="85774827925">Coach Dina (Dina Yuliana)</x-inputs.select-option>
                                                    @else
                                                        @foreach ($this->coaches as $coach)
                                                            <x-inputs.select-option value="{{ $coach->code }}">Coach {{ $coach->nick_name }} ({{ $coach->coach_name }})</x-inputs.select-option>
                                                        @endforeach
                                                    @endif
                                                </x-inputs.select>
                                                <small class="text-danger">@error('selectedCoach') {{ $message }} @enderror</small>
                                            </div>
                                        {{-- @endif --}}

                                        {{-- @if ($selectedCoach) --}}
                                            <div class="col-lg-6 col-12 mb-3">
                                                <x-inputs.label>Kelas</x-inputs.label>
                                                <x-inputs.select wire:model.live='selectedClass'>
                                                    <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                                    @foreach ($this->classes as $class)
                                                        <x-inputs.select-option value="{{ $class->id }}">
                                                            {{ $class->day }}
                                                            ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                                                        </x-inputs.select-option>
                                                    @endforeach
                                                </x-inputs.select>
                                                <small class="text-danger">@error('selectedClass') {{ $message }} @enderror</small>
                                            </div>
                                        {{-- @endif --}}

                                        <div class="col-lg-6 col-12">
                                            @if ($alertQuota)
                                                <span class="text-danger">Mohon maaf, quota habis. Silahkan pilih kelas yang lain!</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--Transfer Instruction-->
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            @if ($selectedClass)
                                                <b>Rekening Pembayaran</b>
                                                <p>
                                                    Bank : <b class="text-primary">Muamalat</b> <br>
                                                    Rekening : <b class="text-primary">11300-11061</b> <br>
                                                    Nama : <b class="text-primary">Khairino Firman Baisya</b> <br>
                                                    Kode Bank : <b class="text-primary">147</b>
                                                </p>
                                                <div class="mb-2">
                                                    <b>Detail Biaya</b>
                                                    <br>
                                                        Biaya Program : <b>{{ CurrencyHelper::formatRupiah($price) }}</b>
                                                        <br>
                                                        Biaya Admin : <b>{{ CurrencyHelper::formatRupiah($adminFee) }}</b>
                                                        <br>
                                                        @if (!$isReferralCodeError && $referralCodeFound)
                                                            Diskon : (-{{ CurrencyHelper::formatRupiah($discountReferral) }})
                                                            <br/>
                                                        @endif
                                                        Total : <b class="text-primary">{{ CurrencyHelper::formatRupiah($totalPrice) }}</b>
                                                    <br>
                                                </div>
                                            @endif
                                        </div>
                                        <x-inputs.basic type="hidden" wire:model='price'/>
                                        <div class="col-lg-6 col-12 mb-3">
                                            @if ($selectedClass)
                                                <x-inputs.label>Bukti Transfer</x-inputs.label>
                                                <div x-data="{ uploading: false, progress: 5 }" x-on:livewire-upload-start="uploading = true"
                                                    x-on:livewire-upload-finish="uploading = false; progress = 5;"
                                                    x-on:livewire-upload-error="uploading = false"
                                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                    <!--Choose File-->
                                                    <x-inputs.basic type="file" wire:click='selectFile' wire:model='fileUpload'
                                                        accept="image/png, image/jpg, image/jpeg" required
                                                        oninvalid="this.setCustomValidity('Silahkan lampirkan bukti transfer anda')"
                                                        oninput="this.setCustomValidity('')" />

                                                    <!--Progress Bar-->
                                                    @if ($showProgressBar == true)
                                                        <div x-show="uploading">
                                                            <div class="progress mt-2">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                                    role="progressbar" x-bind:style="`width: ${progress}%`"></div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                @error('fileUpload')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                        Anda bisa mengecilkan ukuran file <a href="https://tinyjpg.com/" target="_blank"><b class="text-info">Disini!</b></a>
                                                    </small>
                                                @enderror
                                                @error('fileUpload')
                                                    <!--Tampilkan Gambar Rusak-->
                                                @else
                                                    <div class="col-lg-6 col-12 mt-2">
                                                        @if ($fileUpload)
                                                            <img src="{{ $fileUpload->temporaryUrl() }}" width="200px" height="auto">
                                                        @endif
                                                    </div>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <!--#Transfer Instruction-->
                                </div>
                            </div>
                        @endif

                        {{-- Step 4: Biodata --}}
                        @if ($currentStep == 4)
                        <div class="card mx-auto mb-3">
                            <div class="card-header">
                                <h4>Biodata</h4>
                                <small>Langkah 4/4</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Nama Lengkap</x-inputs.label>
                                        <x-inputs.basic type="text" wire:model='memberName' required
                                        oninvalid="this.setCustomValidity('Siapa nama anda?')"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Usia</x-inputs.label>
                                        <x-inputs.basic type="number" wire:model='ageStart' placeholder='....tahun' required
                                        oninvalid="this.setCustomValidity('Berapa usia anda?)"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Tinggi Badan</x-inputs.label>
                                        <x-inputs.basic type="number" wire:model='bodyHeight' placeholder='....cm' required
                                        oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Berat Badan</x-inputs.label>
                                        <x-inputs.basic type="number" wire:model='bodyWeight' placeholder='....kg' required
                                        oninvalid="this.setCustomValidity('Wajib diisi')"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Alamat</x-inputs.label>
                                        <x-inputs.textarea wire:model.blur='address' required
                                        oninvalid="this.setCustomValidity('Dimana anda tinggal?')"
                                        oninput="this.setCustomValidity('')"></x-inputs.textarea>
                                        @if ($alertAddress)
                                        <small class="text-danger">Penulisan alamat minimal 40 karakter, mohon untuk dilengkapi</small>
                                        @endif

                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Nomor Whatsapp</x-inputs.label>
                                        <div class="input-group mb-3">
                                            <x-inputs.select wire:model.blur='countryPhoneCode' required
                                                oninvalid="this.setCustomValidity('Masukan kode negara anda')"
                                                oninput="this.setCustomValidity('')">
                                                <x-inputs.select-option value="">Kode Negara...</x-inputs.select-option>
                                                @foreach ($phoneCodes as $code)
                                                <x-inputs.select-option value="{{ $code->code }}">+{{ $code->code }} ({{ $code->country_name }})</x-inputs.select-option>
                                                @endforeach
                                            </x-inputs.select>
                                            <x-inputs.basic type="number" step="any" wire:model.blur='phone' placeholder="85763827382" required
                                            oninvalid="this.setCustomValidity('Anda harus mencantumkan nomor whatsapp')"
                                            oninput="this.setCustomValidity('')"/>
                                        </div>
                                        @if ($alertUserExist)
                                            <small class="text-danger">Anda sudah terdaftar, silahkan login
                                                <a href="/login">
                                                <b class="text-info">disini!</b>
                                                </a>
                                            </small>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Negara</x-inputs.label>
                                        <x-inputs.select wire:model.live="countryId" required
                                        oninvalid="this.setCustomValidity('Kolom ini wajib diisi!')"
                                        oninput="this.setCustomValidity('')">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            <x-inputs.select-option value="1">Indonesia</x-inputs.select-option>
                                            @foreach ($countries as $id => $country)
                                                <x-inputs.select-option value="{{ $id }}">{{ $country }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                    </div>
                                    @if ($countryId == 1)
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Provinsi</x-inputs.label>
                                        <x-inputs.select wire:model.live="provinceId">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @foreach ($provinces as $province)
                                                <x-inputs.select-option value="{{ $province->id }}">{{ $province->province_name }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                        <small class="text-danger">@error('provinceId') {{ $message }} @enderror</small>
                                    </div>
                                    @endif

                                    @if ($provinceId)
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Kabupaten</x-inputs.label>
                                        <x-inputs.select wire:model.live="regencyId">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @foreach ($this->regencies as $regency)
                                                <x-inputs.select-option value="{{ $regency->id }}">{{ $regency->regency_name }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                        <small class="text-danger">@error('regencyId') {{ $message }} @enderror</small>
                                    </div>
                                    @endif

                                    @if ($regencyId)
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Kecamatan</x-inputs.label>
                                        <x-inputs.select wire:model.live="districtId">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @foreach ($this->districts as $district)
                                                <x-inputs.select-option value="{{ $district->id }}">{{ $district->district_name }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                        <small class="text-danger">@error('districtId') {{ $message }} @enderror</small>
                                    </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Hasil Pemeriksaan Medis (Jika Ada) .pdf</x-inputs.label>
                                        <x-inputs.basic type="file" wire:model='medicalFile' accept=".pdf, .docx.s"/>
                                    </div>
                                </div>
                                <hr />
                                <span>Simpan dan catat dengan baik <b class="text-primary">Username dan Password</b> anda! Keduanya akan digunakan untuk login ke member area aplikasi reeactive.com</span>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Username</x-inputs.label>
                                        <x-inputs.readonly placeholder="{{ $phone }}"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3" x-data="{ show: false }">
                                        <x-inputs.label>Password</x-inputs.label>
                                        <div class="input-group mb-3" @click="show = !show">
                                            <input :type="show ? 'text' : 'password'" class="form-control form-control-sm" wire:model='password' required oninvalid="this.setCustomValidity('Anda harus membuat password')"
                                            oninput="this.setCustomValidity('')">
                                                <span class="input-group-text" id="basic-addon2" x-show="!show">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                </span>
                                                <span class="input-group-text" id="basic-addon2" x-show="show">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                </span>
                                        </div>
                                        {{-- <x-inputs.basic type="password" placeholder="Ketik password anda disini" wire:model='password' required
                                        oninvalid="this.setCustomValidity('Anda harus membuat password')"
                                        oninput="this.setCustomValidity('')"/> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endif

                        {{-- Action Button --}}
                        <div class="action-button">
                            <div class="row mb-3">
                                <div class="col-12">
                                    @if ($currentStep > 1)
                                    <x-buttons.icon-dark type="button" wire:click='decreaseStep'>
                                        <x-slot name="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                        </x-slot>
                                        Kembali
                                    </x-buttons.icon-dark>
                                    @endif

                                    @if ($currentStep < $totalSteps)
                                        @if (!$nextStep || $isReferralCodeError)
                                        <x-buttons.solid-dark type="button" disabled>
                                            Lanjut
                                        </x-buttons.solid-dark>
                                        @else
                                            @if ($alertQuota)
                                                <x-buttons.solid-dark type="button" disabled>Tidak Bisa Daftar</x-buttons.solid-dark>
                                            @else
                                                @if ($questionThree != 'Less' && $questionFour != 'Iya' && $questionFive != 'Less' && $questionSix != 'Iya' && !$isReferralCodeError)
                                                <x-buttons.icon-primary type="button" wire:click='increaseStep'>
                                                    Lanjut
                                                    <x-slot name="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                    </x-slot>
                                                </x-buttons.icon-primary>
                                                @endif
                                            @endif
                                        @endif
                                    @endif

                                    @if ($currentStep == $totalSteps)
                                        @if ($alertUserExist)
                                            <x-buttons.solid-dark type="button" disabled>Anda Sudah Terdaftar</x-buttons.solid-dark>
                                        @else
                                            @if ($alertAddress)
                                            <x-buttons.solid-dark type="button" disabled>Lengkapi Form Di Atas</x-buttons.solid-dark>
                                            @else
                                                @if ($alertQuota)
                                                    <x-buttons.solid-dark type="button" disabled>Kuota Penuh</x-buttons.solid-dark>
                                                @else
                                                <x-buttons.icon-success type="submit">
                                                    <x-slot name="icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                                    </x-slot>
                                                    Kirim
                                                </x-buttons.icon-success>
                                                @endif
                                            @endif
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="row layout-top-spacing">
            <div class="col-12">
                <x-items.alerts.light-danger>
                    Mohon maaf, saat ini pendaftaran sudah TUTUP! Sampai jumpa di batch berikutnya ^^
                </x-items.alerts.light-danger>
            </div>
            <div class="col-12">
                <a href="/">
                    <x-buttons.solid-secondary>Halaman Utama</x-buttons.solid-secondary>
                </a>
            </div>
        </div>
        @endif
    @else
        <div class="row layout-top-spacing">
            <div class="col-12">
                <x-items.alerts.light-danger>
                    Mohon maaf, pendaftaran belum dibuka. Terima kasih ^^
                </x-items.alerts.light-danger>
            </div>
        </div>
    @endif
</div>
