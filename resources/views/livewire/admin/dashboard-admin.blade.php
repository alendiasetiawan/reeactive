<div>
    @push('customCss')
    <link href="{{ asset('template/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row layout-top-spacing">
        <!--Payment Verification-->
        <div class="col-lg-4 col-md-6 col-12 layout-spacing">
            <x-cards.account-box>
                <x-slot name="image"><img src="{{ asset('template/src/assets/img/icon/wallet.png') }}" alt="money-bag"></x-slot>
                <x-slot name="title">Pemasukan <b class="text-primary">{{ $batch->batch_name }}</b></x-slot>
                <x-slot name="subTitle">{{ 'Rp '.number_format($allRegistrationOpen->where('payment_status', 'Done')->sum('amount_pay'),0,',','.') }}</x-slot>
                <x-slot name="info">
                    @php
                        $needVerification = $allRegistrationOpen->where('payment_status', 'Process')->count();
                    @endphp
                    @if ($needVerification >= 1)
                        <x-items.badges.light-danger>Menunggu Verifikasi : {{ $needVerification }}</x-items.badges.light-danger>
                    @else
                        <x-items.badges.light-success>Menunggu Verifikasi : {{ $needVerification }}</x-items.badges.light-success>
                    @endif

                </x-slot>
                <a wire:navigate href="{{ route('admin::payment_verification') }}">Cek Pembayaran</a>
            </x-cards.account-box>
        </div>
        <!--#Payment Verification-->

        <!--Active Member Per Program-->
        <div class="col-lg-4 col-md-6 col-12 layout-spacing">
            <div class="widget-four">
                <div class="widget-heading">
                    <h5 class="">Member Aktif Per Program <b class="text-primary">{{ $batch->batch_name }}</b></h5>
                </div>
                <div class="widget-content">
                    <div class="vistorsBrowser mb-3">
                        @foreach ($membersPerProgram as $member)
                            @if ($loop->index == 4)
                                @php
                                    $allRegister = $allRegistrationOpen->count();

                                    if ($member->registrations->count() == 0) {
                                        $percent = 0;
                                        $memberCount = 0;
                                    } else {
                                        $percent = Round(($member->registrations->where('program_id', $member->id)->count()/$allRegister) * 100,2);
                                        $memberCount = $member->registrations->where('program_id', $member->id)->count();
                                    }
                                @endphp
                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    </div>
                                    <div class="w-browser-details">
                                        <div class="w-browser-info">
                                            <h6>
                                                {{ $member->program_name }}
                                                ({{ $memberCount }})
                                            </h6>
                                            <p class="browser-count">
                                                {{ $percent }}%
                                            </p>
                                        </div>
                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @foreach ($membersPerProgram as $member)
                            @if ($loop->index == 3)
                                @php
                                    $allRegister = $allRegistrationOpen->count();

                                    if ($member->registrations->count() == 0) {
                                        $percent = 0;
                                        $memberCount = 0;
                                    } else {
                                        $percent = Round(($member->registrations->where('program_id', $member->id)->count()/$allRegister) * 100,2);
                                        $memberCount = $member->registrations->where('program_id', $member->id)->count();
                                    }
                                @endphp
                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                    </div>
                                    <div class="w-browser-details">
                                        <div class="w-browser-info">
                                            <h6>
                                                {{ $member->program_name }}
                                                ({{ $memberCount }})
                                            </h6>
                                            <p class="browser-count">
                                                {{ $percent }}%
                                            </p>
                                        </div>
                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <span>Total Member : {{ $allRegister }}</span> <a href="" data-bs-toggle="modal" data-bs-target="#detailProgram"><b class="text-primary">(Detail)</b></a>
                </div>
                <!--Modal Detail Program-->
                <x-modals.zoomUp id="detailProgram">
                    <x-slot name="modalTitle">Jumlah Member Per Program</x-slot>
                    <x-items.list-groups.basic>
                        @foreach ($membersPerProgram as $data)
                            @php
                                if ($data->registrations->count() == 0) {
                                    $memberActive = 0;
                                } else {
                                    $memberActive = $data->registrations->where('program_id', $data->id)->count();
                                }
                            @endphp
                            <x-items.list-groups.item-basic>
                                <x-slot name="title">{{ $data->program_name }}</x-slot>
                                <x-slot name="subTitle">{{ $memberActive }} Member</x-slot>
                            </x-items.list-groups.item-basic>
                        @endforeach
                    </x-items.list-groups.basic>
                </x-modals.zoomUp>
                <!--#Modal Detail Program-->
            </div>
        </div>
        <!--#Active Member Per Program-->

        <!--Percent Renewal-->
        <div class="col-lg-4 col-md-6 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6>Persentase Renewal Member <b class="text-primary">{{ $batch->batch_name }}</b></h6>
                        </div>
                    </div>

                    <div class="w-content">

                        <div class="w-info">
                            <p class="value">{{ $renewalMember }} <span>Renewal Member</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></p>
                        </div>

                    </div>

                    <div class="w-progress-stats">
                        <div class="progress">
                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $percentRenewalMember }}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <div class="">
                            <div class="w-icon">
                                <p>{{ $percentRenewalMember }}%</p>
                            </div>
                        </div>

                    </div>
                    <span>Jumlah Member Batch Sebelumnya : {{ $qtyLastMember }}</span>
                </div>
            </div>
        </div>
        <!--#Percent Renewal-->
    </div>

    <div class="row">
        <div class="col-lg-6 col-12 layout-spacing">
            <div class="widget">
                <div class="w-header">
                    <div class="w-info">
                        <h5 class="value">Data Member Per Coach <b class="text-primary">{{ $batch->batch_name }}</b></h5>
                    </div>
                </div>
                @persist('chartCoach')
                    <div class="widget-content">
                        {!! $memberChart->container() !!}
                    </div>
                @endpersist()
            </div>
        </div>

        <div class="col-lg-6 col-12 layout-spacing">
            <div class="widget">
                <div class="w-header">
                    <div class="w-info">
                        <h5 class="value">Statistik Jenis Registrasi <b class="text-primary">{{ $batch->batch_name }}</b></h5>
                    </div>
                </div>
                @persist('chartRegistrasi')
                <div class="widget-content">
                    {!! $registerCategoryChart->container() !!}
                </div>
                @endpersist()
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-12 layout-spacing">
            <div class="widget widget-table-two">

                <div class="widget-heading">
                    <h5 class="">Pendaftar Terbaru</h5>
                </div>

                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><div class="th-content">No</div></th>
                                    <th><div class="th-content">Nama</div></th>
                                    <th><div class="th-content">Program</div></th>
                                    <th><div class="th-content">Coach</div></th>
                                    <th><div class="th-content">Pembayaran</div></th>
                                    <th><div class="th-content">Daftar</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allRegistrationOpen as $register)
                                    @if ($loop->index <= 5)
                                        <tr>
                                            <td><div class="td-content"><span>{{ $loop->iteration }}</span></div></td>
                                            <td><div class="td-content customer-name"><span>{{ $register->member_name }}</span></div></td>
                                            <td><div class="td-content product-brand text-primary">{{ $register->program_name }}</div></td>
                                            <td><div class="td-content product-invoice">{{ $register->nick_name }}</div></td>
                                            <td>
                                                <div class="td-content pricing">
                                                    @if ($register->payment_status == 'Done')
                                                        <b class="text-success">Selesai</b>
                                                    @elseif ($register->payment_status == 'Process')
                                                        <b class="text-warning">Proses</b>
                                                    @else
                                                        <b class="text-danger">Tidak Valid</b>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><div class="td-content"><b class="text-secondary">{{ $register->created_at->diffForHumans() }}</b></div></td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                        <a wire:navigate href="#">
                            <x-buttons.solid-primary>Detail</x-buttons.solid-primary>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/assets/js/widgets/modules-widgets.js') }}" data-navigate-once></script>
    <script src="{{ $memberChart->cdn() }}" data-navigate-once></script>

    {{ $memberChart->script() }}

    <script src="{{ $registerCategoryChart->cdn() }}" data-navigate-once></script>

    {{ $registerCategoryChart->script() }}

    <script src="{{ asset('template/src/plugins/src/table/datatable/datatables.js') }}" data-navigate-once></script>
    <script data-navigate-once>
        document.addEventListener('livewire:navigating', () => {

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
