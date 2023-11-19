<div>
    @push('customCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    @endpush

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        <span class="text-secondary">Halaman Utama</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Workshop</li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
        <div class="text-center">
            <h2>Pendaftaran <b class="text-primary">Early Postpartum Workshop & Core Stability Program</b></h2>
        </div>
        <div class="text-center">
            <h5 class="text-secondary">Reeactive x Yofitmos</h5>
        </div>
        <hr>

        @if ($batchOpen)
            @if ($currentStep < 2)
            <div class="text-center">
                <small class="text-info">"Info nominal dan rekening pembayaran akan muncul setelah anda memilih program"</small>
            </div>
            @endif

            @if (session('failed'))
            <div class="text-center">
                <x-items.alerts.light-danger>
                    {{ session('failed') }}
                </x-items.alerts.light-danger>
            </div>
            @endif

            @if (session('fullQuota'))
            <div class="text-center">
                <x-items.alerts.light-danger>
                    {{ session('fullQuota') }}
                </x-items.alerts.light-danger>
            </div>
            @endif

            {{-- Registration Form --}}
            <div class="d-flex align-items-center justify-content-center mt-3">
                <div class="col-lg-7">
                    <form wire:submit='register'>
                        {{-- Step 1 : Terms and Condition --}}
                        @if ($currentStep == 1)
                        <div class="card mx-auto mb-3">
                            <div class="card-header">
                                <h4>Terms and Conditions <b class="text-primary">Core Stability Program</b></h4>
                                <small>Langkah 1/3</small>
                            </div>
                            <div class="card-body">
                                <span>
                                    Berikut ini adalah syarat dan ketentuan bagi anda yang ingin mengikuti <b class="text-primary">"Core Stability Program"</b>, apabila anda hanya ingin mengikuti <b class="text-primary">"Workshop Saja"</b> maka cukup berikan tanda checklist pada setiap poin ketentuan di bawah ini.<br><br>
                                    <b>Checklist tersebut sebagai bukti bahwa anda <b class="text-primary">"Sudah Membaca"</b> poin-poin ketentuan yang ada</b><br><br>
                                </span>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-satu" wire:model='poinSatu'>
                                                <label class="form-check-label" for="poin-satu">
                                                    <b class="text-primary">Minimal 1,5 bulan</b> pasca melahirkan pervaginam atau 3 bulan pasca melahirkan SC dengan acc dokter untuk berolahraga.
                                                    <small class="text-danger"><b>@error('poinSatu') {{ $message }} @enderror</b></small>
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-dua" wire:model='poinDua'>
                                                <label class="form-check-label" for="poin-dua">
                                                    Tidak mengalami prolapse/turun organ, sakit saraf seperti piriformis syndrom atau HNP, hipertensi, jantung dan pernafasan.
                                                    <small class="text-danger"><b>@error('poinDua') {{ $message }} @enderror</b></small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-tiga" wire:model='poinTiga'>
                                                <label class="form-check-label" for="poin-tiga">
                                                    Jika memiliki skoliosis wajib mendapatkan <b class="text-primary">clearance dari sportfisioterapis</b> dan dokter terlebih dahulu untuk berolahraga.
                                                    <small class="text-danger"><b>@error('poinTiga') {{ $message }} @enderror</b></small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="poin-empat" wire:model='poinEmpat'>
                                                <label class="form-check-label" for="poin-empat">
                                                    Tidak sedang melakukan perawatan cidera
                                                </label>
                                                <small class="text-danger"><b>@error('poinEmpat') {{ $message }} @enderror</b></small>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @endif

                        {{-- Step 2 : Pilih Program --}}
                        @if ($currentStep == 2)
                        <div class="card mx-auto mb-3">
                            <div class="card-header">
                                <h4>Pilih Program</h4>
                                <small>Langka 2/3</small>
                            </div>
                            <div class="card-body">
                                <b>Rekening Pembayaran</b>
                                <p>
                                    Bank : <b class="text-primary">Bank Syariah Indonesia</b> <br>
                                    Rekening : <b class="text-primary">725-1586-521</b> <br>
                                    Atas Nama : <b class="text-primary">CV MUSLIMAH BUGAR INDONESIA</b> <br>
                                    Kode Bank : <b class="text-primary">451</b>
                                </p>
                                <b>Nominal Pembayaran
                                    <p>
                                    <em class="text-secondary">
                                        @if (!$selectedProgram)
                                            ...
                                        @else
                                            @if ($isVoucher || $isAssessmentCodeValid)
                                                <s>{{$this->normalPrice}}</s>
                                                {{ $this->price }}
                                            @else
                                                {{ $this->price }}
                                            @endif
                                        @endif
                                    </em>
                                    </p>
                                </b>

                                <div class="row mt-2">
                                    <div class="col-lg-6 col-12 mb-2">
                                        <x-inputs.label>Program</x-inputs.label>
                                        <x-inputs.select wire:model.live='selectedProgram'>
                                            <x-inputs.select-option>--Pilih--</x-inputs.select-option>
                                            @foreach ($programs as $program)
                                                <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                        @if ($selectedProgram == 7)
                                            <small class="text-warning">Anda hanya akan mengikuti workshop, tidak lanjut ke assessment dan core stability program</small>
                                        @endif
                                        @if($selectedProgram == 8)
                                            <small class="text-warning">Anda akan mengikuti seluruh program, yaitu : <b>Workshop + Assessment (Bagi yang belum) + Core Stability Program</b></small>
                                        @endif
                                        <small class="text-danger">@error('selectedProgram') {{ $message }} @enderror</small>
                                    </div>

                                    @if($selectedProgram)
                                    <div class="col-lg-6 col-12 mb-2">
                                        <x-inputs.label>Waktu</x-inputs.label>
                                        <x-inputs.basic type="text" placeholder="{{ $this->classCoach->day }}" disabled />
                                    </div>
                                    @endif

                                    @if ($selectedProgram == 7)
                                    <div class="col-lg-6 col-12 mb-2">
                                        <x-inputs.label>Voucher Member</x-inputs.label>
                                        <x-inputs.basic type="text" wire:model.live='voucherMember' placeholder="Jika ada memiliki voucher, tulis disini!"/>
                                        @if ($alertDiscount && $voucherMember != NULL)
                                            @if ($isVoucher)
                                                <small class="text-info">Yey! Voucher valid, anda berhak mendapatkan discount biaya pendaftaran</small>
                                            @else
                                                <small class="text-danger">Mohon maaf, voucher yang anda masukan tidak valid</small>
                                            @endif
                                        @endif
                                    </div>
                                    @endif

                                    @if ($selectedProgram == 8)
                                    <div class="col-lg-6 col-12 mb-2">
                                        <x-inputs.label>Apakah Anda Sudah Pernah Personal Assessment Periode Oktober 2023 Bersama Coach Arum?</x-inputs.label>
                                        <small class="text-danger text-form">@error('assessmentDone') {{ $message }} @enderror</small>
                                        <br>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="assessment-done-jawaban-satu" name="assessment-done" value="Sudah" wire:model.live='assessmentDone'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="assessment-done-jawaban-satu ">Sudah</x-slot>
                                        </x-inputs.radio-primary>
                                        <x-inputs.radio-primary>
                                            <x-inputs.check-radio id="assessment-done-jawaban-dua" name="assessment-done" value="Belum" wire:model.live='assessmentDone'></x-inputs.check-radio>
                                            <x-slot name="labelRadio" for="pertanyaan-delapan-jawaban-dua">Belum</x-slot>
                                        </x-inputs.radio-primary>
                                    </div>
                                    @endif

                                    @if ($assessmentDone == 'Sudah')
                                        <div class="col-lg-6 col-12 mb-2">
                                            <x-inputs.label>Kode Verifikasi Assessment (Untuk Discount)</x-inputs.label>
                                            <x-inputs.basic type="text" wire:model.live.debounce.250ms='assessmentVerification' placeholder="Tulis nomor HP, ex : 085775745484"/>
                                            <small class="text-danger text-form">@error('assessmentVerification') {{ $message }} @enderror</small>
                                            @if ($assessmentVerification != NULL)
                                                @if ($isAssessmentCodeValid)
                                                    <small class="text-info">Hi, <b class="text-primary">"{{ $assessmentData->valid_name }}"</b>. Kamu berhak mendapatkan discount biaya pendaftaran</small>
                                                @else
                                                    <small class="text-danger">Mohon maaf, kode yang anda masukan tidak valid</small>
                                                @endif
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                @if ($quotaLeft <= 0)
                                <div class="row">
                                    <div class="col-12">
                                        <x-items.alerts.light-danger>Mohon maaf, kuota sudah penuh. Silahkan pilih program yang lain!</x-items.alerts.light-danger>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                        @endif

                        {{-- Step 3 : Isi Biodata --}}
                        @if ($currentStep == 3)
                        <div class="card mx-auto mb-3">
                            <div class="card-header">
                                <h4>Isi Biodata</h4>
                                <small>Langkah 3/3</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Nama Lengkap</x-inputs.label>
                                        <x-inputs.basic type="text" wire:model.blur='memberName' required
                                        oninvalid="this.setCustomValidity('Siapa nama anda?)"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Usia</x-inputs.label>
                                        <x-inputs.basic type="number" step="any" wire:model='ageStart' placeholder='....tahun' required
                                        oninvalid="this.setCustomValidity('Berapa usia anda?)"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Tinggi Badan</x-inputs.label>
                                        <x-inputs.basic type="number" step="any" wire:model='bodyHeight' placeholder='....cm' required
                                        oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Berat Badan</x-inputs.label>
                                        <x-inputs.basic type="number" step="any" wire:model='bodyWeight' placeholder='....kg' required
                                        oninvalid="this.setCustomValidity('Wajib diisi')"
                                        oninput="this.setCustomValidity('')"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Alamat</x-inputs.label>
                                        <x-inputs.textarea wire:model.blur='address' required
                                        oninvalid="this.setCustomValidity('Dimana anda tinggal?')"
                                        oninput="this.setCustomValidity('')"></x-inputs.textarea>
                                        @if ($alertAddress)
                                        <small class="text-danger">Penulisan alamat minimal 40 karakter, mohon untuk dilengkapi!</small>
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
                                        <x-inputs.label>Provinsi</x-inputs.label>
                                        <x-inputs.select wire:model.live="provinceId">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @foreach ($provinces as $province)
                                                <x-inputs.select-option value="{{ $province->id }}">{{ $province->province_name }}</x-inputs.select-option>
                                            @endforeach
                                        </x-inputs.select>
                                        <small class="text-danger">@error('provinceId') {{ $message }} @enderror</small>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Kabupaten</x-inputs.label>
                                        <x-inputs.select wire:model.live="regencyId">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @if ($provinceId)
                                                @foreach ($this->regencies as $regency)
                                                <x-inputs.select-option value="{{ $regency->id }}">{{ $regency->regency_name }}</x-inputs.select-option>
                                                @endforeach
                                            @endif
                                        </x-inputs.select>
                                        <small class="text-danger">@error('regencyId') {{ $message }} @enderror</small>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Kecamatan</x-inputs.label>
                                        <x-inputs.select wire:model.live="districtId">
                                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                                            @if ($regencyId)
                                            @foreach ($this->districts as $district)
                                                <x-inputs.select-option value="{{ $district->id }}">{{ $district->district_name }}</x-inputs.select-option>
                                            @endforeach
                                            @endif
                                        </x-inputs.select>
                                        <small class="text-danger">@error('districtId') {{ $message }} @enderror</small>
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Riwayat Persalinan</x-inputs.label>
                                        <textarea class="form-control" rows="5" placeholder="Tahun : 2018 (Metode Pervaginam) - Tahun 2021 (Metode Caesar)" wire:model='medicalCondition'></textarea>
                                        @error('medicalCondition')
                                        <small class="text-danger">{{ $message }}</small>
                                        @else
                                        <small class="form-text text-muted">Tulis semua riwayat persalinan anda, sebutkan tahun dan metode nya</small>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
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
                                    </div>
                                </div>

                                <div class="row">
                                    @error('fileUpload')
                                        <!--Tampilkan Gambar Rusak-->
                                    @else
                                        <div class="col-lg-6 col-12 mb-3">
                                            @if ($fileUpload)
                                                <img src="{{ $fileUpload->temporaryUrl() }}" width="200px" height="auto">
                                            @endif
                                        </div>
                                    @enderror
                                </div>
                                <hr />
                                <span>Simpan dan catat dengan baik <b class="text-primary">username dan password</b> anda! Keduanya akan digunakan untuk login ke member area reeactive</span>
                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Username</x-inputs.label>
                                        <x-inputs.readonly placeholder="{{ $phone }}"/>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <x-inputs.label>Password</x-inputs.label>
                                        <x-inputs.basic type="password" wire:model='password' required
                                        oninvalid="this.setCustomValidity('Anda harus membuat password')"
                                        oninput="this.setCustomValidity('')"/>
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

                                    @if ($currentStep < $totalStep)
                                        @if ($quotaLeft <= 0)
                                            <x-buttons.solid-dark type="button" disabled>Tidak Bisa Daftar</x-buttons.solid-dark>
                                        @else
                                            <x-buttons.icon-primary type="button" wire:click='increaseStep'>
                                                Lanjut
                                                <x-slot name="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </x-slot>
                                            </x-buttons.icon-primary>
                                        @endif
                                    @endif

                                    @if ($currentStep == $totalStep)
                                        @if ($alertUserExist)
                                            <x-buttons.solid-dark type="button" disabled>Anda Sudah Terdaftar</x-buttons.solid-dark>
                                        @else
                                            @if ($alertAddress)
                                            <x-buttons.solid-dark type="button" disabled>Lengkapi Form Di Atas</x-buttons.solid-dark>
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

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
        <div class="text-center">
            <x-items.alerts.light-danger>
                Mohon maaf, pendaftaran sudah tutup!
            </x-items.alerts.light-danger>
        </div>
        @endif
    </div>
</div>
