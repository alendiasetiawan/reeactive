@extends('layouts.master')

@push('customCss')
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/dark/elements/alert.css') }}">
<link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
<link href="{{ asset('template/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/dark/widgets/modules-widgets.css') }}">
<link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/src/assets/css/light/components/carousel.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
@endpush

@section('content')
<div class="row layout-top-spacing">
    <!--Alert Pendaftaran-->
    <div class="col-12">
        @if ($batchOpen == 1)
        <div class="col-12">
            @if ($checkBatch[0]->registrations->count() == 0)
            <x-items.alerts.light-info>
                Pendaftaran <b>"{{ $checkBatch[0]->batch_name }}"</b> telah dibuka, ayo daftar sekarang! Batas
                waktu sampai {{ \Carbon\Carbon::parse($checkBatch[0]->end_date)->isoFormat('D MMM Y') }}.
                <a wire:navigate href="{{ route('member::renewal_registration') }}">
                    <x-buttons.outline-success>Daftar Sekarang</x-buttons.outline-success>
                </a>
            </x-items.alerts.light-info>
            @else
            @if ($checkBatch[0]->registrations[0]->payment_status == 'Process')
            <x-items.alerts.light-success>
                Pendaftaran anda di <b>"{{ $checkBatch[0]->batch_name }}"</b> sedang kami proses, mohon
                kesediannya untuk menunggu. Terima Kasih
            </x-items.alerts.light-success>
            @endif
            @if ($checkBatch[0]->registrations[0]->payment_status == 'Invalid')
            <x-items.alerts.light-danger>
                Status pendaftaran anda di <b>{{ $checkBatch[0]->batch_name }}</b>
                <b class="text-danger">"Tidak Valid"</b>.
                <x-buttons.outline-danger>Cek Sekarang</x-buttons.outline-danger>
            </x-items.alerts.light-danger>
            @endif
            @endif
        </div>
        @endif
    </div>
    <!--#Alert Pendaftaran-->

    <!--Info Program-->
    <div class="col-lg-4 col-md-6 col-12 layout-spacing">
        <x-cards.account-box>
            <x-slot name="image">
                <img src="{{ asset('template/src/assets/img/icon/dumble.png') }}" alt="dumble">
            </x-slot>
            <x-slot name="title">Ahlan, {{ \Str::words(Auth::user()->full_name, 2, '') }}</x-slot>
            <x-slot name="subTitle">{{ $member->program_name }}</x-slot>
            <x-slot name="badgeLabel">
                @if ($member->payment_status == 'Done')
                <x-items.badges.light-success>{{ $member->batch_name }} - Coach
                    {{ $member->nick_name }}</x-items.badges.light-success>
                @else
                <x-items.badges.light-dark>{{ $member->batch_name }} - (Pending)</x-items.badges.light-dark>
                @endif

            </x-slot>
            <x-slot name="info">
                @if ($member->payment_status == 'Done')
                <a href="{{ $member->link_wa }}" target="_blank">
                    <button class="btn btn-success btn-sm">
                        Join WA Group
                    </button>
                </a>
                @else
                <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#grupWa">Join WA
                    Group</button>
                @endif
            </x-slot>
            <a href="#" data-bs-toggle="modal" data-bs-target="#detailProgram">Detail Program</a>
        </x-cards.account-box>

        <!--Modal Detail Program-->
        <x-modals.zoomUp id="detailProgram">
            <x-slot name="modalTitle">Detail Program</x-slot>
            <x-items.list-groups.basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Batch</x-slot>
                    <x-slot name="subTitle">{{ $member->batch_name }}</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Program</x-slot>
                    <x-slot name="subTitle">{{ $member->program_name }}</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Level</x-slot>
                    <x-slot name="subTitle">{{ $member->level_name }}</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Coach</x-slot>
                    <x-slot name="subTitle">{{ $member->nick_name }} ({{ $member->coach_name }})</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Kelas</x-slot>
                    <x-slot name="subTitle">
                        {{ $member->day }}
                        ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})
                    </x-slot>
                </x-items.list-groups.item-basic>
            </x-items.list-groups.basic>
        </x-modals.zoomUp>
        <!--#Modal Detail Program-->

        <!--Modal Join Group WA-->
        <x-modals.fadeInUp id="grupWa">
            <x-slot name="modalTitle">Upss.. Tidak Bisa Join Group WA</x-slot>
            <em class="text-danger">Anda bisa bergabung grup WA setelah status pembayaran anda dinyatakan "Valid"</em>
        </x-modals.fadeInUp>
        <!--#Modal Join Group WA-->
    </div>
    <!--#Info Program-->

    <!--Registrations Log-->
    <div class="col-lg-4 col-md-6 col-12 layout-spacing">
        <x-cards.wallet>
            <x-slot name="header">Pendaftaran Terkini</x-slot>
            <x-slot name="mainTitle">{{ $registrations[0]->batch_name }}</x-slot>
            <x-slot name="info">Pembayaran :
                @if ($registrations[0]->payment_status == 'Done')
                <b class="text-primary">Selesai</b>
                @elseif ($registrations[0]->payment_status == 'Process')
                <b class="text-warning">Proses</b>
                @else
                <b class="text-danger">Invalid</b>
                @endif
            </x-slot>
            <x-slot name="buttonActionOne">
                <a wire:navigate href="{{ route('member::renewal_registration.show', $registrations[0]->id) }}">
                    <x-buttons.outline-primary>Detail</x-buttons.outline-primary>
                </a>
            </x-slot>
            <x-slot name="buttonActionTwo">
                <a wire:navigate href="{{ route('member::renewal_registration') }}">
                    <x-buttons.solid-success>Daftar</x-buttons.solid-success>
                </a>
            </x-slot>
            <x-items.list-groups.advance>
                @foreach ($registrations as $register)
                @if ($loop->index <= 1) <x-items.list-groups.item-advance>
                    <x-slot name="title">{{ $register->batch_name }}</x-slot>
                    <x-slot name="subTitle">{{ $register->created_at->diffForHumans() }}</x-slot>
                    <x-slot name="info">
                        <a wire:navigate href="{{ route('member::renewal_registration.show', $register->id) }}">
                            @if ($register->payment_status == 'Done')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-check-circle text-success">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-alert-circle text-warning">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            @endif
                        </a>
                    </x-slot>
                    </x-items.list-groups.item-advance>
                    @endif
                    @endforeach
            </x-items.list-groups.advance>
            {{-- <x-slot name="callToAction">Lihat Riwayat Pendaftaran</x-slot> --}}
        </x-cards.wallet>
    </div>
    <!--#Registrations Log-->
</div>
@endsection

@push('customScripts')
<script src="{{ asset('template/src/plugins/src/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}"></script>
<script src="{{ asset('template/src/assets/js/elements/tooltip.js') }}"></script>
<script src="{{ asset('template/src/assets/js/scrollspyNav.js') }}"></script>
@endpush
