<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Database Jadwal Kelas</x-slot:title>
        <x-slot:activePage>Database Jadwal Kelas</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Button Add Request Class-->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <x-buttons.basic color="primary" class="btn-sm" data-bs-toggle="dropdown">
                +
                Tambah Kelas
            </x-buttons.basic>
            <div class="dropdown-menu">
                <a href="" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addClassModal" wire:click='setFormReguler'>
                    Request Kelas Reguler
                </a>
                <a href="" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addClassModal" wire:click='setFormLepasan'>
                    Request Kelas Lepasan
                </a>
            </div>
        </div>
    </div>
    <!--#Button Add Request Class-->

    <!--List Reguler Class-->
    <div class="row">
        <div class="col-12">
            <div class="divider divider-start divider-primary">
                <div class="divider-text">
                    <b>Program Reguler</b>
                </div>
            </div>
        </div>
        @foreach ($this->programs as $program)
            @if ($program->classes->count() != 0)
                <div class="col-lg-4 col-md-6 col-12">
                    <x-cards.employee>
                        <x-slot:header>{{ $program->program_name }}</x-slot:header>
                        @foreach ($program->classes as $class)
                            <x-cards.employee-task wire:key='{{ $class->id }}'>
                                <x-slot:title>{{ $class->day }}</x-slot:title>
                                <x-slot:subTitle>
                                    {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                    @if ($class->link_wa != null)
                                        <x-items.wa-icon href="{{ $class->link_wa }}" />
                                    @endif
                                </x-slot:subTitle>
                                <x-slot:label>
                                    <span class="{{ $class->class_status_eksternal == 'Open' ? 'text-success' : ($class->class_status_eksternal == 'Pending' ? 'text-warning' : 'text-danger') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status New Member">{{ $class->class_status_eksternal }}</span>
                                    |
                                    <span class="{{ $class->class_status_eksternal == 'Open' ? 'text-success' : ($class->class_status_eksternal == 'Pending' ? 'text-warning' : 'text-danger') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status Renewal">{{ $class->class_status }}</span>
                                </x-slot:label>
                            </x-cards.employee-task>
                        @endforeach
                    </x-cards.employee>
                </div>
            @endif
        @endforeach
    </div>
    <!--#List Reguler Class-->

    <!--List Kelas Lepasan-->
    <div class="row">
        <div class="col-12">
            <div class="divider divider-start divider-primary">
                <div class="divider-text">
                    <b>Kelas Lepasan</b>
                </div>
            </div>
        </div>

        @if ($isHaveKelasLepasan)
            @foreach ($this->lepasanPrograms as $program)
                @if ($program->classes->count() != 0)
                    <div class="col-lg-4 col-md-6 col-12">
                        <x-cards.employee>
                            <x-slot:header>{{ $program->program_name }}</x-slot:header>
                            @foreach ($program->classes as $class)
                                <x-cards.employee-task wire:key='{{ $class->id }}'>
                                    <x-slot:title>{{ \App\Helpers\TanggalHelper::convertImplodeDay($class->day) }}</x-slot:title>
                                    <x-slot:subTitle>
                                        {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                        @if ($class->link_wa != null)
                                            <x-items.wa-icon href="{{ $class->link_wa }}" />
                                        @endif
                                    </x-slot:subTitle>
                                    <x-slot:label>
                                        <span class="{{ $class->class_status_eksternal == 'Open' ? 'text-success' : ($class->class_status_eksternal == 'Pending' ? 'text-warning' : 'text-danger') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status New Member">{{ $class->class_status_eksternal }}</span>
                                        |
                                        <span class="{{ $class->class_status_eksternal == 'Open' ? 'text-success' : ($class->class_status_eksternal == 'Pending' ? 'text-warning' : 'text-danger') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status Renewal">{{ $class->class_status }}</span>
                                    </x-slot:label>
                                </x-cards.employee-task>
                            @endforeach
                        </x-cards.employee>
                    </div>
                @endif
            @endforeach
        @else
            <div class="col-12">
                <x-alerts.main-alert color="danger">
                    Anda belum memiliki jadwal di Kelas Lepasan
                </x-alerts.main-alert>
            </div>
        @endif
    </div>
    <!--#List Kelas Lepasan-->

    <!--Modal Add Reguler Class-->
    <x-vuexy.modals.center-modal id="addClassModal" wire:ignore.self>
        <x-slot:modal_title>
            Form Request Kelas {{ $isFormReguler ? 'Reguler' : 'Lepasan' }}
        </x-slot:modal_title>
        <x-slot:modal_form>
            @if (session('request-failed'))
                <div class="row">
                    <div class="col-12">
                        <x-alerts.main-alert color="danger">{{ session('request-failed') }}</x-alerts.main-alert>
                    </div>
                </div>
            @endif
            <form wire:submit='sendRequest'>
                <div class="row">
                    <div class="col-12 mb-1">
                        <x-inputs.label>Program</x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live='selectedProgram'>
                            <x-inputs.vuexy-select-option value="" disabled selected>--Pilih--</x-inputs.vuexy-select-option>
                            @if ($isFormReguler)
                                @foreach ($listPrograms as $program)
                                    <x-inputs.vuexy-select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.vuexy-select-option>
                                @endforeach
                            @endif

                            @if ($isFormLepasan)
                                @foreach ($listProgramsLepasan as $program)
                                    <x-inputs.vuexy-select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.vuexy-select-option>
                                @endforeach
                            @endif
                        </x-inputs.vuexy-select>
                    </div>
                    <div class="col-12 mb-1">
                        <x-inputs.label>Hari</x-inputs.label>
                        @if ($isFormReguler)
                        <x-inputs.vuexy-basic placeholder="Senin, Rabu, Jum'at" wire:model.live.debounce.250ms='day'/>
                        @endif

                        @if ($isFormLepasan)
                            @foreach ($listOfDays as $key => $value)
                                <x-inputs.checkbox id="hari{{ $key }}" wire:model.live='selectedDays' value="{{ $key }}">
                                    <x-slot:label for="hari{{ $key }}">{{ $value }}</x-slot:label>
                                </x-inputs.checkbox>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-lg-6 col-12 mb-1" wire:ignore>
                        <x-inputs.label>Waktu Mulai</x-inputs.label>
                        <input type="text" id="fp-time" class="form-control flatpickr-time text-start" placeholder="HH:MM" wire:model.live='startTime'/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1" wire:ignore>
                        <x-inputs.label>Waktu Selesai</x-inputs.label>
                        <input type="text" id="fp-time" class="form-control flatpickr-time text-start" placeholder="HH:MM" wire:model.live='endTime'/>
                    </div>
                    <div class="col-12 mb-1">
                        <x-inputs.label>Link Join Grup Whatsapp</x-inputs.label>
                        <x-inputs.vuexy-basic wire:model.live.debounce.250ms='linkWa'/>
                    </div>
                    <div class="col-12 mb-1">
                        <x-buttons.basic color="primary" class="w-100" type="submit" :disabled="$isSubmitActive ? false : true">
                            Kirim
                        </x-buttons.basic>
                    </div>
                    <div class="col-12 mb-1">
                        <x-buttons.outline-dark class="w-100" type="button" data-bs-dismiss="modal">
                            Batal
                        </x-buttons.outline-dark>
                    </div>
                </div>
            </form>
        </x-slot:modal_form>
    </x-vuexy.modals.center-modal>
    <!--#Modal Add Reguler Class-->

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

        <script data-navigate-once>
            window.addEventListener('request-sent', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                   // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    '👋Request kelas berhasil dikirim',
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
    @endpush
</div>
