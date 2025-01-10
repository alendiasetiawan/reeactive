<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/pages/authentication.css') }}">
    @endpush

    <div class="text-center mb-2">
        <h2>Formulir Pendaftaran Program Kelas Lepas</h2>
    </div>
    <x-vuexy.cards.basic-card>
            <x-slot:cardHeader>Terms and Conditions</x-slot:cardHeader>
            <ol>
                <li>Khusus Muslimah</li>
                <li>Registrasi minimal 1 x 24 jam sebelum sesi berlangsung</li>
                <li>Reschedule maksimal 2x</li>
                <li>Durasi latihan 60 menit</li>
                <li>Kondisi sehat (tidak ada riwayat cedera/kelainan tulang belakang)</li>
                <li>Tidak sedang hamil (bagi peserta mat pilates)</li>
                <li>Menggunakan pakaian yg menutup aurat sesama wanita (tidak ketat/transparan)</li>
                <li>No show/tanpa kabar maka sesi hangus (no reschedule/refund)</li>
            </ol>
    </x-vuexy.cards.basic-card>

    <x-vuexy.cards.basic-card>
        <x-slot:cardHeader>Formulir</x-slot:cardHeader>
        <small>Silahkan isi form di bawah ini dengan <strong>lengkap dan benar!</strong></small>
        <br/>
        <small>Pastikan anda menggunakan browser terbaru yang disarankan : <strong>Chrome/Edge/Firefox</strong></small>
        <form wire:submit='register'>
            <!--Program-->
            <div class="row">
                <div class="col-12">
                    <x-items.divider color="primary" position="center">
                        Program
                    </x-items.divider>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-1">
                    <x-inputs.label>Program</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live='selectedProgram'>
                        <x-inputs.vuexy-select-option value="" selected disabled>--Pilih--</x-inputs.vuexy-select-option>
                        @foreach ($programs as $program)
                            <x-inputs.vuexy-select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.vuexy-select-option>
                        @endforeach
                    </x-inputs.vuexy-select>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-1">
                    <x-inputs.label>Coach</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live='selectedCoach'>
                        <x-inputs.vuexy-select-option value="" selected disabled>--Pilih--</x-inputs.vuexy-select-option>
                        @foreach ($this->coaches as $coach)
                            <x-inputs.vuexy-select-option value="{{ $coach->code }}">Coach {{ $coach->nick_name }}</x-inputs.vuexy-select-option>
                        @endforeach
                    </x-inputs.vuexy-select>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-1">
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
                <div class="col-lg-3 col-md-6 col-12 mb-1">
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

            @if ($selectedSession != null)
                <div class="row">
                    <small class="text-muted">Silahkan pilih tanggal yang sesuai dengan hari yang tersedia, yaitu : <strong class="text-danger">{{ \App\Helpers\TanggalHelper::convertImplodeDay($selectedDay) }}</strong></small>
                    @for ($i = 0; $i < $selectedSession; $i++)
                        <div class="col-lg-3 col-md-6 col-12 mb-1" wire:ignore>
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
            <!--#Program-->

            <!--Screening-->
            @if ($selectedSession && $isPregnantFriendly == 0)
                <div class="row">
                    <div class="col-12">
                        <x-items.divider color="primary" position="center">
                            Screening
                        </x-items.divider>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Usia Kandungan</x-inputs.label>
                        <x-inputs.vuexy-basic type="number" step="any" placeholder="... pekan" wire:model.live.debounce.250ms='pregnantWeek'/>
                        @error('pregnantWeek')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    @if ($pregnantWeek >= 12)
                        <div class="col-lg-4 col-md-6 col-12 mb-1">
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
                        <div class="col-lg-4 col-md-6 col-12 mb-1">
                            <x-inputs.label>Detail Keluhan</x-inputs.label>
                            <x-inputs.textarea placeholder="Tuliskan detail keluhan yang anda rasakan selama kehamilan" rows="3" wire:model.live.debounce.250ms='pregnantSyndromDetail'></x-inputs.textarea>
                            @error('pregnantSyndromDetail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif
                </div>

                @if ($pregnantWeek && $pregnantWeek < 12)
                    <div class="row">
                        <div class="col-12">
                            <x-alerts.main-alert color="danger">
                                Usia kandungan anda kurang dari 12 pekan, mohon maaf anda belum bisa mengikuti kelas ini!
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

            <!--Biodata-->
            <div class="row">
                <div class="col-12">
                    <x-items.divider color="primary" position="center">
                        Biodata
                    </x-items.divider>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-1">
                    <x-inputs.label>Nama Lengkap</x-inputs.label>
                    <x-inputs.vuexy-basic wire:model.live.debounce.250ms='memberName'/>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-1" wire:ignore>
                    <x-inputs.label>Tanggal Lahir</x-inputs.label>
                    <x-inputs.date-max-today wire:model.live='birthDate'/>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-1">
                    <x-inputs.label>Usia (Tahun)</x-inputs.label>
                    <x-inputs.vuexy-basic wire:model='ageStart' placeholder="...tahun" disabled/>
                </div>
                <div class="col-lg-4 col-12 mb-1">
                    <x-inputs.label>Tinggi Badan</x-inputs.label>
                    <x-inputs.vuexy-basic type="number" wire:model.live.debounce.250ms='bodyHeight' placeholder='....cm'/>
                    @if ($isBodyHeightInvalid)
                        <small class="text-danger">Batas tinggi badan adalah 100 cm - 250 cm</small>
                    @endif
                </div>
                <div class="col-lg-4 col-12 mb-1">
                    <x-inputs.label>Berat Badan</x-inputs.label>
                    <x-inputs.vuexy-basic type="number" wire:model.live.debounce.250ms='bodyWeight' placeholder='....kg'/>
                    @if ($isBodyWeightInvalid)
                        <small class="text-danger">Batas tinggi badan adalah 30 kg - 200 kg</small>
                    @endif
                </div>
                <div class="col-lg-4 col-12 mb-1">
                    <x-inputs.label>Nomor Whatsapp</x-inputs.label>
                    <x-inputs.input-group>
                        <x-slot:firstInput>
                            <x-inputs.vuexy-select wire:model='countryCode'>
                                @foreach ($phoneCodes as $code)
                                    <x-inputs.vuexy-select-option value="{{ $code->code }}">+{{ $code->code }}</x-inputs.vuexy-select-option>
                                @endforeach
                            </x-inputs.vuexy-select>
                        </x-slot:firstInput>
                        <x-slot:secondInput>
                            <x-inputs.vuexy-basic type="number" step="any" wire:model.live.debounce.250ms='phone'/>
                        </x-slot:secondInput>
                    </x-inputs.input-group>
                    @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if ($isUserRegistered)
                        <small class="text-danger">Nomor anda sudah terdaftar, silahkan login!
                            <a href="{{ route('login') }}"><u>Member Area</u></a>
                        </small>
                    @endif
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Alamat</x-inputs.label>
                    <x-inputs.textarea wire:model.live.debounce.250ms='address'></x-inputs.textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="textarea-counter-value float-end">
                        <span class="char-count">{{ $addressLength }}</span> / {{ $maxAddressLength }}
                    </small>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Negara</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live='countryId'>
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        <x-inputs.select-option value="1">Indonesia</x-inputs.select-option>
                        @foreach ($countries as $id => $country)
                            <x-inputs.select-option value="{{ $id }}">{{ $country }}</x-inputs.select-option>
                        @endforeach
                    </x-inputs.vuexy-select>
                </div>

                @if ($countryId == 1)
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Provinsi</x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live="provinceId">
                            <x-inputs.vuexy-select-option value="" selected>--Pilih--</x-inputs.vuexy-select-option>
                            @foreach ($provinces as $id => $province)
                                <x-inputs.select-option value="{{ $id }}">{{ $province }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.vuexy-select>
                        <small class="text-danger">@error('provinceId') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Kabupaten</x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live="regencyId">
                            <x-inputs.vuexy-select-option value="" selected>--Pilih--</x-inputs.vuexy-select-option>
                            @foreach ($this->regencies as $id => $regency)
                                <x-inputs.select-option value="{{ $id }}">{{ $regency }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.vuexy-select>
                        <small class="text-danger">@error('regencyId') {{ $message }} @enderror</small>
                    </div>

                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Kecamatan</x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live="districtId">
                            <x-inputs.vuexy-select-option value="" selected>--Pilih--</x-inputs.vuexy-select-option>
                            @foreach ($this->districts as $id => $district)
                                <x-inputs.select-option value="{{ $id }}">{{ $district }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.vuexy-select>
                        <small class="text-danger">@error('districtId') {{ $message }} @enderror</small>
                    </div>
                @endif
            </div>
            <!--#Biodata-->

            <!--Account Detail-->
            <div class="row">
                <div class="col-12">
                    <x-items.divider color="primary" position="center">
                        Akun Untuk Login
                    </x-items.divider>
                </div>
                <span>Catat <b class="text-primary">Username dan Password</b> anda dengan baik, karena keduanya akan digunakan untuk login ke member area!</span>
                <div class="col-lg-6 col-12 mb-1 mt-1">
                    <x-inputs.label>Username</x-inputs.label>
                    <x-inputs.vuexy-basic value="{{ $phone }}" disabled/>
                </div>
                <div class="col-lg-6 col-12 mb-1 mt-1" wire:ignore>
                    <x-inputs.label>Password</x-inputs.label>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control form-control-merge" id="password" type="password" wire:model.live.debounce.250ms='password' placeholder="············"/>
                        <span class="input-group-text cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </span>
                    </div>
                </div>
            </div>
            <!--Account Detail-->

            <div class="row">
                <div class="col-12" wire:loading.remove wire:target='register'>
                    <x-buttons.basic color="primary" type="submit" :disabled="$isSubmitActive && !$errors->any() && !$isUserRegistered && $isAllowedToJoin ? false : true">
                        Daftar
                    </x-buttons.basic>
                </div>
                <div class="col-12" wire:loading wire:target='register'>
                    <x-vuexy.buttons.spinner>
                        <x-slot:buttonName>Mengirim Data...</x-slot:buttonName>
                    </x-vuexy.buttons.spinner>
                </div>
            </div>
        </form>
    </x-vuexy.cards.basic-card>

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/pages/auth-login.js') }}"></script>
        <script src="{{ asset('style/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
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
