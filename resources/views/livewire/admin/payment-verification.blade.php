<div>
    @push('customCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/src/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
        <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
        <link href="{{ asset('template/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    @endpush

    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Verifikasi Transfer</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        @if (session('paymentSaved'))
        <div class="col-12 layout-spacing">
            <x-items.alerts.light-success>{{ session('paymentSaved') }}</x-items.alerts.light-success>
        </div>
        @endif
        <div class="col-12">
            <div class="widget">
                <div class="widget-heading">
                    <h4 class="">Tabel Verifikasi Pembayaran Member <b class="text-primary">{{ $batchName }}</b></h4>
                </div>
                <div class="widget-content">

                    <table id="paymentsTable" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Member</th>
                                <th>Program</th>
                                <th>Coach</th>
                                <th>Nominal Transfer</th>
                                <th>Waktu Upload</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $payment->member_name }}
                                    </td>
                                    <td>{{ $payment->program_name }}</td>
                                    <td>{{ $payment->nick_name }}</td>
                                    <td>{{ 'Rp '.number_format($payment->amount_pay,0,',','.') }}</td>
                                    <td>{{ $payment->created_at->isoFormat('lll') }}</td>
                                    <td>
                                        @if ($payment->payment_status == 'Done')
                                            <b class="text-success">Selesai</b>
                                        @elseif ($payment->payment_status == 'Process')
                                            <b class="text-warning">Proses</b>
                                        @else
                                            <b class="text-danger">Tidak Valid</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a wire:navigate href="{{ route('admin::payment_verification.show', $payment->id) }}">
                                            <x-buttons.solid-primary>Detail</x-buttons.solid-primary>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Member</th>
                                <th>Program</th>
                                <th>Coach</th>
                                <th>Nominal Transfer</th>
                                <th>Waktu Upload</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('customScripts')
        <script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}" data-navigate-once></script>
        <script src="{{ asset('template/src/plugins/src/table/datatable/datatables.js') }}" data-navigate-once></script>
        <script data-navigate-once>
            document.addEventListener('livewire:navigated', () => {

                $('#paymentsTable').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                    "oLanguage": {
                        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                        "sInfo": "Showing page _PAGE_ of _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                    },
                    "stripeClasses": [],
                    "lengthMenu": [7, 10, 20, 50],
                    "pageLength": 10
                });
            })
        </script>

        <script data-navigate-once>
            document.addEventListener('livewire:initialized', () => {

                $('#paymentsTable').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                    "oLanguage": {
                        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                        "sInfo": "Showing page _PAGE_ of _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                    },
                    "stripeClasses": [],
                    "lengthMenu": [7, 10, 20, 50],
                    "pageLength": 10
                });
            })
        </script>
    @endpush
</div>
