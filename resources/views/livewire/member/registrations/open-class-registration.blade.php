<div>

    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/pages/authentication.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Daftar Kelas Lepasan</x-slot:title>
        <x-slot:firstPage href="{{ route('member::registration_portal') }}">Portal Pendaftaran</x-slot:firstPage>
        <x-slot:activePage>Daftar Kelas Lepasan</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    @if ($this->isRegistrationProcess)
        <div class="row">
            <div class="col-12">
                <x-alerts.main-alert color="info">
                    Pendaftaran anda sedang diproses, mohon untuk menunggu validasi dari Admin. Terima Kasih ^^
                </x-alerts.main-alert>
            </div>
        </div>
    @endif

    <div class="row">
        <!--Registration Form-->
        <div class="col-lg-7 col-md-7 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Form Kelas Lepasan</x-slot:cardTitle>
                <form wire:submit='register'>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-1">
                            <x-inputs.label>Program</x-inputs.label>
                            <x-inputs.vuexy-select wire:model.live='selectedProgram'>
                                <x-inputs.select-option value="" disabled selected>--Pilih--</x-inputs.select-option>
                                @foreach ($programs as $program)
                                    <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                                @endforeach
                            </x-inputs.vuexy-select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-1">
                            <x-inputs.label>Coach</x-inputs.label>
                            <x-inputs.vuexy-select wire:model.live='selectedCoach'>
                                <x-inputs.vuexy-select-option value="" selected disabled>--Pilih--</x-inputs.vuexy-select-option>
                                @foreach ($this->coaches as $coach)
                                    <x-inputs.vuexy-select-option value="{{ $coach->code }}">Coach {{ $coach->nick_name }}</x-inputs.vuexy-select-option>
                                @endforeach
                            </x-inputs.vuexy-select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-1">
                            <x-inputs.label>Kelas</x-inputs.label>
                            <x-inputs.vuexy-select wire:model.live='selectedClass'>
                                <x-inputs.vuexy-select-option value="" selected disabled>--Pilih--</x-inputs.vuexy-select-option>
                                @foreach ($this->classes as $class)
                                    <x-inputs.vuexy-select-option value="{{ $class->id }}">
                                        {{ \App\Helpers\TanggalHelper::convertImplodeDay($class->day) }} ({{ $class->start_time }} - {{ $class->end_time }})
                                    </x-inputs.vuexy-select-option>
                                @endforeach
                            </x-inputs.vuexy-select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mb-1">
                            <x-inputs.label>Jumlah Sesi</x-inputs.label>
                            <x-inputs.vuexy-select wire:model.live='selectedSession'>
                                <x-inputs.vuexy-select-option value=null selected disabled>--Pilih--</x-inputs.vuexy-select-option>
                                @if ($selectedClass)
                                    <x-inputs.vuexy-select-option value="1">1 Sesi</x-inputs.vuexy-select-option>
                                    <x-inputs.vuexy-select-option value="4">4 Sesi</x-inputs.vuexy-select-option>
                                @endif
                            </x-inputs.vuexy-select>
                        </div>
                    </div>

                    <!--Screening-->
                    @if ($selectedSession && $isPregnantFriendly == 0)
                        <div class="row">
                            <div class="col-12">
                                <x-items.divider color="primary" position="center">
                                    Screening
                                </x-items.divider>
                            </div>
                            <div class="col-lg-6 col-12 mb-1">
                                <x-inputs.label>Usia Kandungan</x-inputs.label>
                                <x-inputs.vuexy-basic type="number" step="any" placeholder="... pekan" wire:model.live.debounce.250ms='pregnantWeek'/>
                                @error('pregnantWeek')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if ($pregnantWeek >= 12)
                                <div class="col-lg-6 col-12 mb-1">
                                    <x-inputs.label>Apakah ada keluhan selama kehamilan?</x-inputs.label>
                                    <br/>
                                    <x-inputs.radio-primary>
                                        <x-inputs.check-radio id="answer-yes" name="pregnant-syndrom" value="Yes" wire:model.live='isPregnantSyndrom' required
                                        oninvalid="this.setCustomValidity('Wajib diisi!')"
                                        oninput="this.setCustomValidity('')"></x-inputs.check-radio>
                                        <x-slot name="labelRadio" for="answer-yes">Iya</x-slot>
                                    </x-inputs.radio-primary>
                                    <x-inputs.radio-primary>
                                        <x-inputs.check-radio id="answer-no" name="pregnant-syndrom" value="No" wire:model.live='isPregnantSyndrom'></x-inputs.check-radio>
                                        <x-slot name="labelRadio" for="answer-no">Tidak</x-slot>
                                    </x-inputs.radio-primary>
                                </div>
                            @endif
                            @if ($isPregnantSyndrom == 'Yes')
                                <div class="col-12 mb-1">
                                    <x-inputs.label>Detail Keluhan</x-inputs.label>
                                    <x-inputs.textarea placeholder="Tuliskan detail keluhan yang anda rasakan selama kehamilan" rows="3" wire:model.live.debounce.250ms='pregnantSyndromDetail'></x-inputs.textarea>
                                    @error('pregnantSyndromDetail')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif
                        </div>

                        @if ($pregnantWeek && !$isAllowedToJoin)
                            <div class="row">
                                <div class="col-12">
                                    <x-alerts.main-alert color="danger">
                                        Usia kandungan anda kurang dari 12 pekan, mohon maaf anda belum bisa mengikuti kelas ini!
                                    </x-alerts.main-alert>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if ($selectedSession != null)
                        <div class="row">
                            <small class="text-muted">Silahkan pilih tanggal yang sesuai dengan hari yang tersedia, yaitu : <strong class="text-danger">{{ \App\Helpers\TanggalHelper::convertImplodeDay($selectedDay) }}</strong></small>
                            @for ($i = 0; $i < $selectedSession; $i++)
                                <div class="col-lg-6 col-12 mb-1" wire:ignore>
                                    <x-inputs.label>Pilih Tanggal {{ $i + 1 }}</x-inputs.label>
                                    <x-inputs.date-picker wire:model.live='selectedDate.{{ $i }}' required
                                    oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')"
                                    oninput="this.setCustomValidity('')" />
                                </div>
                            @endfor
                        </div>

                        @if ($invalidDay)
                            <div class="row">
                                <div class="col-12">
                                    <x-alerts.main-alert color="danger">
                                        Upss.. Tanggal yang anda pilih tidak sesuai dengan pilihan hari yang tersedia, silahkan pilih tanggal lainnya!
                                    </x-alerts.main-alert>
                                </div>
                            </div>
                        @endif
                    @endif
                    <!--#Screening-->

                    <!--Payment-->
                    @if ($selectedSession)
                        <div class="row">
                            <div class="col-12">
                                <x-items.divider color="primary" position="center">
                                    Biaya
                                </x-items.divider>
                            </div>
                            <div class="col-lg-6 col-12">
                                <p>
                                    <b>Detail Biaya</b>
                                    <br/>
                                    Biaya Program : <strong class="text-primary">{{ \App\Helpers\CurrencyHelper::formatRupiah($programPrice) }}</strong>
                                    <br/><br/>
                                    <b>Rekening Pembayaran</b>
                                    <br/>
                                    Bank : <b class="text-primary">Muamalat</b> <br>
                                    Rekening : <b class="text-primary">1130011061</b> <br>
                                    Nama : <b class="text-primary">Khairino Firman Baisya</b> <br>
                                    Kode Bank : <b class="text-primary">147</b>
                                </p>
                            </div>
                            <div class="col-lg-6 col-12">
                                <x-inputs.label>Lampiran Bukti Transfer (Max : 1 Mb)</x-inputs.label>
                                <div x-data="{ uploading: false, progress: 5 }" x-on:livewire-upload-start="uploading = true"
                                    x-on:livewire-upload-finish="uploading = false; progress = 5;"
                                    x-on:livewire-upload-error="uploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <!--Choose File-->
                                    <x-inputs.vuexy-basic type="file" wire:click='selectFile' wire:model.live='fileUpload'
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
                                <small class="text-muted">Anda bisa mengecilkan ukuran file <a href="https://tinyjpg.com/" target="_blank"><b class="text-info">Disini!</b></a></small>
                                <br/>
                                @error('fileUpload')
                                    <small class="text-danger">
                                        {{ $message }}
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
                            </div>
                        </div>
                    @endif
                    <!--#Payment-->

                    <!--Submit Button-->
                    <div class="row">
                        <div class="col-12 mb-1">
                            @if ($this->isRegistrationProcess)
                                <x-buttons.basic color="dark" disabled>Daftar</x-buttons.basic>
                            @else
                                <x-buttons.basic color="primary" type="submit" :disabled="$isSubmitActive && !$errors->any() ? false : true">
                                    Daftar
                                </x-buttons.basic>
                            @endif
                        </div>
                    </div>
                    <!--#Submit Button-->

                    <!--ALERT WHEN REGISTRATION IS FAILED-->
                        @if (session('registration-failed'))
                        <div class="row">
                            <div class="col-12">
                                <x-alerts.main-alert color="danger">
                                    {{ session('registration-failed') }}
                                </x-alerts.main-alert>
                            </div>
                        </div>
                    @endif
                    <!--#ALERT WHEN REGISTRATION IS FAILED-->
                </form>
            </x-cards.basic-card>
        </div>
        <!--#Registration Form-->

        <!--History Registration-->
        <div class="col-lg-5 col-md-5 col-12">
            <x-cards.timeline>
                <x-slot:header>Riwayat Pendaftaran</x-slot:header>
                @forelse ($this->latestRegistrations as $registration)
                    <x-cards.timeline-item-financial>
                        <x-slot:number>{{ $loop->iteration }}</x-slot:number>
                        <x-slot:title>
                            {{ $registration->program_name }}
                            <x-badges.light-badge :color="$registration->payment_status == 'Done' ? 'success' : ($registration->payment_status == 'Process' ? 'warning' : 'danger')">{{ $registration->payment_status }}</x-badges.light-badge>
                        </x-slot:title>
                        <x-slot:label>{{ \Carbon\Carbon::parse($registration->created_at)->diffForHumans() }}</x-slot:label>
                        <x-slot:content>
                            Coach {{ $registration->nick_name }} - {{ \App\Helpers\TanggalHelper::convertImplodeDay($registration->day) }}
                            ({{ \Carbon\Carbon::parse($registration->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($registration->end_time)->format('H:i') }})
                        </x-slot:content>
                    </x-cards.timeline-item-financial>
                @empty

                @endforelse
            </x-cards.timeline>
        </div>
        <!--#History Registration-->
    </div>

    @push('vendorScripts')
    <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('style/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/pages/auth-login.js') }}"></script>
        <script src="{{ asset('style/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
        <script>
            window.addEventListener('registration-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    '👋Data setoran berhasil disimpan',
                    'OK!',
                    {
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                    );
                }, 500);
            });
        </script>
        <!--Prevent Back Button-->
        <script type="text/javascript">
            function preventBack() {
                window.history.forward();
            }
            setTimeout("preventBack()", 0);

            window.onunload = function () { null };
        </script>
        <!--#Prevent Back Button-->
        <script>
            Livewire.hook('morph.added',  ({ el }) => {
                (function (window, document, $) {
                'use strict';
                    /*******  Flatpickr  *****/
                    var basicPickr = $('.flatpickr-basic'),
                    timePickr = $('.flatpickr-time'),
                    dateTimePickr = $('.flatpickr-date-time'),
                    dateTimePickrDua = $('.flatpickr-date-time-dua'),
                    limitDownDateTimePickr = $('.limit-down-date-time'),
                    limitDownDateTimePickrDua = $('.limit-down-date-time-dua'),
                    multiPickr = $('.flatpickr-multiple'),
                    rangePickr = $('.flatpickr-range'),
                    humanFriendlyPickr = $('.flatpickr-human-friendly'),
                    disabledRangePickr = $('.flatpickr-disabled-range'),
                    inlineRangePickr = $('.flatpickr-inline'),
                    limitDatePickr = $('.limit-date');

                    //limit date
                    if (limitDatePickr.length) {
                        limitDatePickr.flatpickr({
                            maxDate: 'today'
                        });
                    }

                    if (limitDownDateTimePickr.length) {
                        limitDownDateTimePickr.flatpickr({
                            minDate: 'today'
                        });
                    }

                    if (basicPickr.length) {
                    basicPickr.flatpickr();
                    }

                })(window, document, jQuery);
            })
        </script>
    @endpush
</div>
