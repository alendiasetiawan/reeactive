@extends('layouts.master')

@push('customCss')
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
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
            <div class="col-12 mb-3">
                @if ($checkBatch[0]->registrations->count() == 0)
                    <x-items.alerts.light-info>
                        Pendaftaran <b>"{{ $checkBatch[0]->batch_name }}"</b> telah dibuka, ayo daftar sekarang! Batas waktu sampai {{ \Carbon\Carbon::parse($checkBatch[0]->end_date)->isoFormat('D MMM Y') }}
                    </x-items.alerts.light-info>
                @else
                    @if ($checkBatch[0]->registrations[0]->payment_status != 'Done')
                        <x-items.alerts.light-success>
                            Pendaftaran anda di <b>"{{ $checkBatch[0]->batch_name }}"</b> sedang kami proses, mohon kesediannya untuk menunggu. Terima Kasih
                        </x-items.alerts.light-success>
                    @endif
                @endif
            </div>
        @endif
        <!--#Registration Alert-->

        @if ($isRegisteredInReguler)
            <livewire:member.renewal-form :batchOpen='$batchOpen' :checkBatch='$checkBatch'/>
        @else
            <livewire:member.form-new-member-internal />
        @endif

        <livewire:member.registration-log />
    </div>
@endsection

@push('customScripts')
    <script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/autocomplete/autoComplete.min.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/pages/knowledge-base.js') }}"></script>
        <!--Alert Success-->
    @if (session('registrationSuccess'))
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

    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);

        window.onunload = function () { null };
    </script>
@endpush
