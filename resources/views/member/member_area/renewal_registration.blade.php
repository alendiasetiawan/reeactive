@extends('layouts.app')

@push('customCss')
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/src/plugins/src/autocomplete/css/autoComplete.02.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/src/plugins/css/light/autocomplete/css/custom-autoComplete.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/css/dark/autocomplete/css/custom-autoComplete.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/src/assets/css/light/pages/knowledge_base.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/dark/pages/knowledge_base.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('breadcrumb')
<x-items.breadcrumb>
    <x-slot name="mainPage" href="{{ route('member::dashboard') }}">Dashboard</x-slot>
    <x-slot name="currentPage">Renewal Registration</x-slot>
</x-items.breadcrumb>
@endsection

@section('content')
    <div class="row layout-top-spacing">
        <!--Registration Alert-->
        @if ($batchOpen == 1)
            <div class="col-12">
                @if ($checkBatch[0]->registrations->count() == 0)
                    <x-items.alerts.light-info>
                        Pendaftaran <b>"{{ $checkBatch[0]->batch_name }}"</b> telah dibuka, ayo daftar sekarang! Batas waktu sampai {{ \Carbon\Carbon::parse($checkBatch[0]->end_date)->isoFormat('D MMM Y') }}
                    </x-items.alerts.light-info>
                @else
                    <x-items.alerts.light-success>
                        Pendaftaran anda di <b>"{{ $checkBatch[0]->batch_name }}"</b> sedang kami proses, mohon kesediannya untuk menunggu. Terima Kasih
                    </x-items.alerts.light-success>
                @endif
            </div>
        @endif
        <!--#Registration Alert-->

        <livewire:member.registration-log />

        <livewire:member.renewal-form :batchOpen='$batchOpen' :checkBatch='$checkBatch'/>
    </div>
@endsection

@push('customScripts')
    <script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/autocomplete/autoComplete.min.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/pages/knowledge-base.js') }}"></script>
@endpush
