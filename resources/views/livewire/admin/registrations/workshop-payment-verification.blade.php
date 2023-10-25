<div>
    @push('customCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/src/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/css/light/table/datatable/dt-global_style.css') }}">
        <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    @endpush

    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Verifikasi Workshop</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing mb-3">
        @if (session('paymentSaved'))
        <div class="col-12 layout-spacing">
            <x-items.alerts.light-success>{{ session('paymentSaved') }}</x-items.alerts.light-success>
        </div>
        @endif
        <div class="col-12">
            <div class="widget">
                <div class="widget-heading">
                    <h4 class="">Tabel Verifikasi Pembayaran Workshop</h4>
                </div>
                <div class="widget-content">

                    <table id="workshopPayment" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Program</th>
                                <th>Assessment</th>
                                <th>Whatsapp</th>
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
                                        @if ($payment->voucher_code != NULL)
                                            <x-items.badges.light-primary>Voucher</x-items.badges.light-primary>
                                        @endif
                                    </td>
                                    <td>{{ $payment->program_name }}</td>
                                    <td>
                                        @if ($payment->is_assessment == 1)
                                            <x-items.badges.solid-success>Sudah</x-items.badges.solid-success>
                                        @else
                                            <x-items.badges.solid-dark>Belum</x-items.badges.solid-dark>
                                        @endif
                                    </td>
                                    <td>
                                        +{{ $payment->mobile_phone }}
                                        <a href="https://wa.me/{{ $payment->mobile_phone }}" target="_blank" class="text-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($payment->payment_status == 'Done')
                                            <b class="text-success">Selesai</b>
                                        @elseif ($payment->payment_status == 'Process')
                                            <b class="text-warning">Proses</b>
                                        @else
                                            <b class="text-danger">Tidak Valid</b>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="">
                                                <a class="dropdown-item" wire:navigate href="{{ route('admin::workshop_verification.show', $payment->id) }}">Cek Transfer</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Set Assessment</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($vouchers as $voucher)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                <div class="widget widget-one_hybrid widget-followers">
                    <div class="widget-heading">
                        <div class="w-title">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div class="">
                                <p class="w-value">{{ $voucher->code }}</p>
                                <h5 class="">Pengguna Voucher : {{ $voucher->workshop_registrations->count() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        @foreach ($this->workshopMembers as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.transaction>
                    <x-slot name="cardTitle">Coach {{ $member->nick_name }}</x-slot>
                    @foreach ($member->classes as $class)
                        <x-cards.transaction-list>
                            <x-slot name="mainContent">{{ $class->program_name }}</x-slot>
                            <x-slot name="subContent">{{ $class->day }}</x-slot>
                            <x-slot name="label">
                                <b class="text-info">Member : {{ $class->workshop_registrations->where('class_id', $class->id)->count() }}</b>
                            </x-slot>
                        </x-cards.transaction-list>
                    @endforeach
                </x-cards.transaction>
            </div>
        @endforeach
    </div>

    @push('customScripts')
        <script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}" data-navigate-once></script>
        <script src="{{ asset('template/src/plugins/src/table/datatable/datatables.js') }}" data-navigate-once></script>
        <script data-navigate-once>
            document.addEventListener('livewire:navigated', () => {

                $('#workshopPayment').DataTable({
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

                $('#workshopPayment').DataTable({
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
