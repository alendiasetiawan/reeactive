<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Request Class</x-slot:title>
        <x-slot:activePage>Request Class</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <!--List of Request Class-->
        @forelse ($this->listClasses as $class)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job color="primary">
                    <x-slot:avatarIcon>{{ $loop->iteration }}</x-slot:avatarIcon>
                    <x-slot:title>Coach {{ $class->coach->coach_name }}</x-slot:title>
                    <x-slot:subTitle>Pengajuan : {{ \Carbon\Carbon::parse($class->created_at)->isoFormat('D MMM Y') }}</x-slot:subTitle>
                    <x-slot:headingContent>{{ $class->program->program_name }}</x-slot:headingContent>
                    @if ($class->program->program_type == 'Special')
                        {{ \App\Helpers\TanggalHelper::convertImplodeDay($class->day) }}
                    @else
                        {{ $class->day }}
                    @endif
                    ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})<br/>
                    New Member :
                    @if ($class->class_status_eksternal == 'Pending')
                        <b class="text-warning">Pending</b>
                    @elseif ($class->class_status_eksternal == 'Open')
                        <b class="text-success">Open</b>
                    @else
                        <b class="text-danger">Close</b>
                    @endif
                    <br/>
                    Renewal :
                    @if ($class->class_status == 'Pending')
                        <b class="text-warning">Pending</b>
                    @elseif ($class->class_status == 'Open')
                        <b class="text-success">Open</b>
                    @else
                        <b class="text-danger">Close</b>
                    @endif
                    <br/>
                    <x-slot:actionButton>
                        <x-buttons.basic color="primary" class="w-100" data-bs-toggle="modal" data-bs-target="#processRequestModal" wire:click="approve({{ $class->id }})">Proses</x-buttons.basic>
                    </x-slot:actionButton>
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found/>
            </div>
        @endforelse
        <!--#List of Request Class-->
    </div>

    <!--Process Request Modal-->
    <x-modals.center-modal id="processRequestModal" wire:ignore.self>
        <x-slot:modal_title>Proses Request Kelas</x-slot:modal_title>
        <x-slot:modal_form>
            <form wire:submit='proccessRequest'>
                <div class="row">
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Coach</h6>
                    <span>{{ $detailClass?->coach->coach_name }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Program</h6>
                    <span>{{ $detailClass?->program->program_name }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Hari</h6>
                    <span>
                        @if ($detailClass?->program->program_type == 'Special')
                            {{ \App\Helpers\TanggalHelper::convertImplodeDay($detailClass?->day) }}
                        @else
                            {{ $detailClass?->day }}
                        @endif
                    </span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Waktu</h6>
                    <span>{{ \Carbon\Carbon::parse($detailClass?->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($detailClass?->end_time)->format('H:i') }}</span>
                </div>
                <div class="col-12 mb-1">
                    <x-inputs.label>Link Join Group Whatsapp</x-inputs.label>
                    <div class="input-group form-password-toggle">
                        <x-inputs.vuexy-basic value="{{ $detailClass?->link_wa }}" disabled/>
                        <span class="input-group-text cursor-pointer">
                            <a href="{{ $detailClass?->link_wa }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Status New Member</x-inputs.label>
                    <x-inputs.vuexy-select wire:model='statusNewMember'>
                        <x-inputs.vuexy-select-option>Pending</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option>Open</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option>Close</x-inputs.vuexy-select-option>
                    </x-inputs.vuexy-select>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Status Renewal</x-inputs.label>
                    <x-inputs.vuexy-select wire:model='statusRenewal'>
                        <x-inputs.vuexy-select-option>Pending</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option>Open</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option>Close</x-inputs.vuexy-select-option>
                    </x-inputs.vuexy-select>
                </div>
                <div class="col-12 mb-1 text-center">
                    <x-buttons.basic color="primary" class="me-25" type="submit">Simpan</x-buttons.basic>
                    <x-buttons.outline-dark data-bs-dismiss="modal" type="button">Batal</x-buttons.outline-dark>
                </div>
                </div>
            </form>
        </x-slot:modal_form>
    </x-modals.center-modal>
    <!--#Process Request Modal-->

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
        <script data-navigate-once>
            window.addEventListener('class-approved', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    '👋Request kelas berhasil diproses',
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
