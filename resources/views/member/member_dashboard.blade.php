@extends('layouts.app')

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
<link href="{{ asset('template/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('template/src/assets/css/light/elements/tooltip.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="row layout-top-spacing">
    <!--Info Program-->
    <div class="col-lg-4 col-md-6 col-12">
        <x-cards.account-box>
            <x-slot name="image">
                <img src="{{ asset('template/src/assets/img/icon/dumble.png') }}" alt="dumble">
            </x-slot>
            <x-slot name="title">Ahlan, {{ \Str::words(Auth::user()->full_name,2,'') }}</x-slot>
            <x-slot name="subTitle">{{ $infoProgram->program_name }}</x-slot>
            <x-slot name="badgeLabel">
                @if ($infoProgram->payment_status == 'Done')
                    <x-items.badges.light-success>{{ $infoProgram->batch_name }} - Coach {{ $infoProgram->nick_name }}</x-items.badges.light-success>
                @else
                    <x-items.badges.light-dark>{{ $infoProgram->batch_name }} - (Pending)</x-items.badges.light-dark>
                @endif

            </x-slot>
            <x-slot name="info">
                @if ($infoProgram->payment_status == 'Done')
                    <button class="btn btn-success btn-sm">
                        Join WA Group
                    </button>
                @else
                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#grupWa">Join WA Group</button>
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
                    <x-slot name="subTitle">{{ $infoProgram->batch_name }}</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Program</x-slot>
                    <x-slot name="subTitle">{{ $infoProgram->program_name }}</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Level</x-slot>
                    <x-slot name="subTitle">{{ $infoProgram->level_name }}</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Coach</x-slot>
                    <x-slot name="subTitle">{{ $infoProgram->nick_name }} ({{ $infoProgram->coach_name }})</x-slot>
                </x-items.list-groups.item-basic>
                <x-items.list-groups.item-basic>
                    <x-slot name="title">Kelas</x-slot>
                    <x-slot name="subTitle">
                        {{ $infoProgram->day }}
                        ({{ \Carbon\Carbon::parse($infoProgram->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($infoProgram->end_time)->format('H:i') }})
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
    <div class="col-lg-4 col-md-6 col-12">

    </div>
    <!--#Registrations Log-->
</div>
@endsection

@push('customScripts')
<script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}"></script>
<script src="{{ asset('template/src/assets/js/elements/tooltip.js') }}"></script>
<script src="{{ asset('template/src/assets/js/scrollspyNav.js') }}"></script>
@endpush
