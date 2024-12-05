<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
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
        <form>
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
                    <x-inputs.label>Usia</x-inputs.label>
                    <x-inputs.vuexy-basic wire:model='ageStart' disabled/>
                </div>
                <div class="col-lg-4 col-12 mb-1">
                    <x-inputs.label>Tinggi Badan</x-inputs.label>
                    <x-inputs.vuexy-basic type="number" wire:model.live.debounce.250ms='bodyHeight' placeholder='....cm'/>
                </div>
                <div class="col-lg-4 col-12 mb-1">
                    <x-inputs.label>Berat Badan</x-inputs.label>
                    <x-inputs.vuexy-basic type="number" wire:model.live.debounce.250ms='bodyWeight' placeholder='....kg'/>
                </div>
                <div class="col-lg-4 col-12 mb-1">
                    <x-inputs.label>Nomor Whatsapp</x-inputs.label>
                    <x-inputs.input-group>
                        <x-slot:firstInput>
                            <x-inputs.vuexy-select wire:model='countryCode'>
                                <x-inputs.vuexy-select-option value="+62">+62</x-inputs.vuexy-select-option>
                            </x-inputs.vuexy-select>
                        </x-slot:firstInput>
                        <x-slot:secondInput>
                            <x-inputs.vuexy-basic type="number" wire:model.live.debounce.250ms='phone'/>
                        </x-slot:secondInput>
                    </x-inputs.input-group>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Alamat</x-inputs.label>
                    <x-inputs.textarea wire:model.live.debounce.250ms='address'></x-inputs.textarea>
                    <small class="textarea-counter-value float-end">
                        <span class="char-count">0</span> / 20
                    </small>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Negara</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live='countryId'>
                        <x-inputs.vuexy-select-option value="Indonesia">Indonesia</x-inputs.vuexy-select-option>
                    </x-inputs.vuexy-select>
                </div>

                @if ($countryId == 1)
                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Provinsi</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live="provinceId">
                        <x-inputs.vuexy-select-option value="" selected>--Pilih--</x-inputs.vuexy-select-option>
                        {{-- @foreach ($provinces as $province)
                            <x-inputs.select-option value="{{ $province->id }}">{{ $province->province_name }}</x-inputs.select-option>
                        @endforeach --}}
                    </x-inputs.vuexy-select>
                    <small class="text-danger">@error('provinceId') {{ $message }} @enderror</small>
                </div>

                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Kabupaten</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live="regencyId">
                        <x-inputs.vuexy-select-option value="" selected>--Pilih--</x-inputs.vuexy-select-option>
                        {{-- @foreach ($this->regencies as $regency)
                            <x-inputs.select-option value="{{ $regency->id }}">{{ $regency->regency_name }}</x-inputs.select-option>
                        @endforeach --}}
                    </x-inputs.vuexy-select>
                    <small class="text-danger">@error('regencyId') {{ $message }} @enderror</small>
                </div>

                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Kecamatan</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live="districtId">
                        <x-inputs.vuexy-select-option value="" selected>--Pilih--</x-inputs.vuexy-select-option>
                        {{-- @foreach ($this->districts as $district)
                            <x-inputs.select-option value="{{ $district->id }}">{{ $district->district_name }}</x-inputs.select-option>
                        @endforeach --}}
                    </x-inputs.vuexy-select>
                    <small class="text-danger">@error('districtId') {{ $message }} @enderror</small>
                </div>
                @endif
            </div>
            <!--#Biodata-->

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
                            <x-inputs.vuexy-select-option value="{{ $class->id }}">{{ $class->day }}</x-inputs.vuexy-select-option>
                        @endforeach
                    </x-inputs.vuexy-select>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-1">
                    <x-inputs.label>Jumlah Sesi</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live='selectedSession'>
                        <x-inputs.vuexy-select-option value=null selected disabled>--Pilih--</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option value="1">1 Sesi</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option value="4">4 Sesi</x-inputs.vuexy-select-option>
                    </x-inputs.vuexy-select>
                </div>
            </div>

            @if ($selectedSession != null)
                <div class="row">
                    <small class="text-muted">Silahkan pilih tanggal yang sesuai dengan hari [Senin/Rabu/Jum'at]</small>
                    @for ($i = 0; $i < $selectedSession; $i++)
                        <div class="col-lg-3 col-md-6 col-12 mb-1" wire:ignore>
                            <x-inputs.label>Pilih Tanggal {{ $i + 1 }}</x-inputs.label>
                            <x-inputs.date-max-today wire:model.live='sessionDate.{{ $i }}'/>
                        </div>
                    @endfor
                </div>
            @endif
            <!--#Program-->
        </form>
    </x-vuexy.cards.basic-card>

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
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

                })(window, document, jQuery);
            })
        </script>
    @endpush
</div>
