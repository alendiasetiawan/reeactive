<div>
    @push('customCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('member::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Workshop Lanjutan</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        @if (session('fullQuota'))
        <div class="col-12">
            <x-items.alerts.light-danger>
                {{ session('fullQuota') }}
            </x-items.alerts.light-danger>
        </div>
        @endif

        @if (session('failed'))
        <div class="col-12">
            <x-items.alerts.light-danger>
                {{ session('failed') }}
            </x-items.alerts.light-danger>
        </div>
        @endif

        <div class="col-lg-8 col-12">
            <x-cards.basic-card>
                <x-slot name="cardTitle">Form Lanjutan Program Workshop</x-slot>
                <h5><b class="text-primary">Informasi</b></h5>
                <p>
                    Form pendaftaran program setelah workshop, anda akan mengikuti <b>Assessment dan Core Stability Program</b>
                </p>
                @if ($program->program_status == 'Close')
                    <x-items.alerts.light-danger>
                        Mohon maaf, saat ini pendaftaran belum dibuka!
                    </x-items.alerts.light-danger>
                @else
                <hr>
                    @if (Auth::user()->type == 'Reguler')
                        <x-items.alerts.light-danger>Mohon maaf, program ini tidak untuk member reeactive</x-items.alerts.light-danger>
                    @else
                        @if ($userExist)
                            <x-items.alerts.light-success>Selamat! anda sudah terdaftar di <b>"Assessment dan Core Stability Program"</b></x-items.alerts.light-success>
                        @else
                        <h5 class="text-primary"><b>Instruksi Transfer</b></h5>
                        <p>
                            Pembayaran dapat dilakukan melalui transfer ke rekening berikut :<br>
                            Bank : <b>Bank Syariah Indonesia</b> <br>
                            Rekening : <b>725-1586-521</b> <br>
                            Atas Nama : <b>CV MUSLIMAH BUGAR INDONESIA</b> <br>
                            Kode Bank : <b>451</b>
                        </p>
                        <h6><b class="text-primary">Nominal Transfer :
                            @if ($assessmentStatus == 'Sudah')
                                <s>{{ $normalPrice }}</s>
                                {{ $price }}
                            @else
                            {{ $price }}
                            @endif
                        </b></h6>
                        <hr>
                        <form wire:submit='saveData' class="mt-3">
                            <div class="row">
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Nama Lengkap</x-inputs.label>
                                    <x-inputs.disable-text placeholder="{{ Auth::user()->full_name }}"></x-inputs.disable-text>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Program</x-inputs.label>
                                    <x-inputs.basic type="text" placeholder="Core Stability Program" disabled/>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <x-inputs.label>Status Assessment</x-inputs.label>
                                    <x-inputs.basic type="text" placeholder="{{ $assessmentStatus }}" disabled/>
                                    @if ($assessmentStatus == 'Sudah')
                                        <small class="text-info text-form">Selamat anda mendapatkan diskon!</small>
                                    @endif
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

                            <div class="row">
                                <div class="col-12">
                                    @if ($quotaLeft <= 0)
                                        <span class="text-danger">Mohon maaf, quota sudah penuh. Anda tidak bisa daftar!</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-12">
                                    @if ($isBatchOpen == 1)
                                        @if ($quotaLeft <= 0)
                                            <button class="btn btn-dark" disabled>Tidak Bisa Daftar</button>
                                        @else
                                            @if (!$userExist)
                                                @error('fileUpload')
                                                    <button class="btn btn-dark" disabled>Tidak Bisa Daftar</button>
                                                @else
                                                    <button class="btn btn-primary" type="submit">Daftar</button>
                                                @enderror
                                            @else
                                                <button class="btn btn-dark" disabled>Anda Sudah Terdaftar</button>
                                            @endif
                                        @endif
                                    @else
                                        <button class="btn btn-dark" disabled>Pendaftaran Tutup</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                        @endif
                    @endif
                @endif
            </x-cards.basic-card>
        </div>
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    @if (session('register-success'))
        <script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Selamat! Pendaftaran Berhasil',
                showConfirmButton: false,
                timer: 2000
                })
        </script>
    @endif
    @endpush
</div>
