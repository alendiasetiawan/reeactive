<div>
    @push('customCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}">
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/components/carousel.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    @endpush

    <div class="row layout-top-spacing">
        <!--Alert Pendaftaran-->
        @if ($batchOpen == 1)
        <div class="col-12 mb-3">
            @if ($checkBatch[0]->registrations->count() == 0)
            <x-items.alerts.light-primary>
                Pendaftaran <b>"{{ $checkBatch[0]->batch_name }}"</b> telah dibuka, ayo daftar sekarang!
                <a wire:navigate href="{{ route('member::renewal_registration') }}">
                    <x-buttons.solid-secondary class="btn-sm">Daftar Sekarang</x-buttons.solid-secondary>
                </a>
            </x-items.alerts.light-primary>
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

        @if ($isWorkshopPaymentProcess)
        <div class="col-12 mb-3">
            <x-items.alerts.light-success>
                Pendaftaran anda di <b>"{{ $activeWorkshop->program_name }}"</b> sedang kami proses, mohon
                kesediannya untuk menunggu. Terima Kasih
            </x-items.alerts.light-success>
        </div>
        @endif

        {{-- Alert Default Password --}}
        @if (Auth::user()->default_pw == 1)
        <div class="col-12 mb-3">
            <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-2" role="alert">
                <button type="button" data-bs-toggle="modal" data-bs-target="#confirmDefaultPassword" class="btn-close" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <strong>Anda masih menggunakan password asli, untuk keamanan silahkan ganti password anda
                    <a href="{{ route('ganti_password') }}">
                        <x-buttons.outline-danger class="btn-sm">Ganti Password</x-buttons.outline-danger>
                    </a>
                </strong>
            </div>
            <!--Modal Confirm Default PW-->
            <x-modals.fadeInUp id="confirmDefaultPassword">
                <x-slot name="modalTitle">Konfirmasi Default Password</x-slot>
                Anda tidak akan melihat notifikasi ini lagi, apakah benar anda ingin tetap menggunakan password asli dari sistem?
                <x-slot name="okButton">
                    <x-buttons.solid-primary wire:click="confirmDefaultPassword">Iya</x-buttons.solid-primary>
                </x-slot>
            </x-modals.fadeInUp>
            <!--#Modal Confirm Default PW-->
        </div>
        @endif

        @if ($isRegisteredInWorkshop)
        {{-- Detail Workshop --}}
        <div class="col-lg-4 col-md-6 col-12 layout-spacing">
            <x-cards.account-box>
                <x-slot name="image">
                    <img src="{{ asset('template/src/assets/img/icon/dumble.png') }}" alt="dumble">
                </x-slot>
                <x-slot name="title">Ahlan, {{ \Str::words(Auth::user()->full_name, 2, '') }}</x-slot>
                <x-slot name="subTitle">{{ $activeWorkshop->program_name ?? '' }}</x-slot>
                <x-slot name="badgeLabel">
                    @if ($activeWorkshop->payment_status == 'Done')
                    <x-items.badges.light-success>
                        Coach {{ $activeWorkshop->nick_name }} (Aktif)
                    </x-items.badges.light-success>
                    @else
                    <x-items.badges.light-dark>Coach {{ $activeWorkshop->nick_name }} (Pending)</x-items.badges.light-dark>
                    @endif
                </x-slot>
                <x-slot name="info">
                    @if ($activeWorkshop->payment_status == 'Done')
                    <a href="{{ $activeWorkshop->link_wa }}" target="_blank">
                        <button class="btn btn-success btn-sm">
                            Join WA Group
                        </button>
                    </a>
                    @else
                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#grupWa">Join WA
                        Group</button>
                    @endif
                </x-slot>
                @if (Auth::user()->type == 'Workshop')
                <x-slot name="moreInfo">
                    <a wire:navigate href="{{ route('member::continue_workshop_form') }}">
                        <button class="btn btn-outline-secondary btn-sm">Daftar Program Lanjutan</button>
                    </a>
                </x-slot>
                @endif

                <a href="#" data-bs-toggle="modal" data-bs-target="#detailProgram">Detail Program</a>
            </x-cards.account-box>

            <!--Modal Detail Program-->
            <x-modals.zoomUp id="detailProgram">
                <x-slot name="modalTitle">Detail Program</x-slot>
                <x-items.list-groups.basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Program</x-slot>
                        <x-slot name="subTitle">{{ $activeWorkshop->program_name }}</x-slot>
                    </x-items.list-groups.item-basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Coach</x-slot>
                        <x-slot name="subTitle">{{ $activeWorkshop->nick_name }}</x-slot>
                    </x-items.list-groups.item-basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Waktu</x-slot>
                        <x-slot name="subTitle">{{ $activeWorkshop->day }}</x-slot>
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
        @endif

        <!--Alert Success Upload Payment-->
        @if (session('re-upload-success'))
            <div class="col-12 mb-2">
                <x-items.alerts.light-success>
                    {{ session('re-upload-success') }}
                </x-items.alerts.light-success>
            </div>
        @endif
        <!--#Alert Success Upload Payment-->

        {{-- Detail Program Reeactive --}}
        <div class="col-lg-6 col-md-6 col-12 layout-spacing">
            <x-cards.account-box>
                <x-slot name="image">
                    <img src="{{ asset('template/src/assets/img/icon/dumble.png') }}" alt="dumble">
                </x-slot>
                <x-slot name="title">Hi, {{ \Str::excerpt(Auth::user()->full_name, '', [
                    'radius' => 19,
                ]) }}</x-slot>
                <x-slot name="subTitle">{{ $member->program_name ?? '' }}</x-slot>
                @if ($isRegisteredInReeactive)
                    <x-slot name="badgeLabel">
                        @if ($member->payment_status == 'Done' || $member->payment_status == 'Follow Up')
                        <x-items.badges.light-success>{{ $member->batch_name }} - Coach
                            {{ $member->nick_name }}</x-items.badges.light-success>
                        @elseif ($member->payment_status == 'Invalid')
                            <x-items.badges.light-danger>Pembayaran - (Invalid)</x-items.badges.light-danger>
                        @else
                            <x-items.badges.light-warning>Pembayaran - (Proses)</x-items.badges.light-warning>
                        @endif
                    </x-slot>
                @else
                    <x-slot name="badgeLabel">
                        Anda belum terdaftar di program reguler
                    </x-slot>
                @endif

                @if ($isRegisteredInReeactive)
                    <x-slot name="info">
                        @if ($member->payment_status == 'Done' || $member->payment_status == 'Follow Up')
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
                @endif
                @if ($isRegisteredInReeactive)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailProgram">Detail Program</a>
                @else
                    <a href="{{ route('member::renewal_registration') }}">Daftar</a>
                @endif

                @if ($isRegisteredInReeactive)
                    @if ($member->payment_status == 'Invalid')
                        <x-slot:action>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#invalidPayment" wire:click='invalidRegulerProgram'>
                                <small>
                                    Detail Invalid
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </small>
                            </a>
                        </x-slot:action>
                    @endif
                @endif
            </x-cards.account-box>

            <!--Modal Detail Program-->
            @if ($isRegisteredInReeactive)
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
            @endif
            <!--#Modal Detail Program-->
        </div>
        {{-- Detail Program Reeactive --}}

        <!--Detail Kelas Lepas-->
        <div class="col-lg-6 col-md-6 col-12 layout-spacing">
            <x-cards.account-box>
                <x-slot name="image">
                    <img src="{{ asset('template/src/assets/img/icon/dumble.png') }}" alt="dumble">
                </x-slot>
                <x-slot name="title">Kelas Lepasan</x-slot>
                <x-slot:subTitle>{{ $latestSpecialRegistration[0]->program_name ?? '' }}</x-slot:subTitle>
                @if ($isSpecialRegistration)
                    <x-slot name="info">
                        @if ($latestSpecialRegistration[0]->payment_status == 'Done' || $latestSpecialRegistration[0]->payment_status == 'Follow Up')
                        <a href="{{ $latestSpecialRegistration[0]->link_wa }}" target="_blank">
                            <button class="btn btn-success btn-sm">
                                Join WA Group
                            </button>
                        </a>
                        @else
                        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#grupWa">Join WA
                            Group</button>
                        @endif
                    </x-slot>
                @endif
                @if ($isSpecialRegistration)
                    <x-slot name="badgeLabel">
                        @if ($latestSpecialRegistration[0]->payment_status == 'Done' || $latestSpecialRegistration[0]->payment_status == 'Follow Up')
                            <x-items.badges.light-success>Coach {{ $latestSpecialRegistration[0]->nick_name }}</x-items.badges.light-success>
                        @elseif ($latestSpecialRegistration[0]->payment_status == 'Invalid')
                            <x-items.badges.light-danger>Pembayaran : Invalid</x-items.badges.light-danger>
                        @else
                            <x-items.badges.light-warning>Pembayaran : Pending</x-items.badges.light-warning>
                        @endif
                    </x-slot>
                @else
                Anda belum daftar di kelas lepasan
                @endif

                @if ($isSpecialRegistration)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailProgramLepas">Detail Program</a>
                @else
                    <a href="{{ route('member::registration_portal') }}">Daftar</a>
                @endif

                @if ($isSpecialRegistration)
                    @if ($latestSpecialRegistration[0]->payment_status == 'Invalid')
                        <x-slot:action>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#invalidPayment" wire:click='invalidSpecialProgram'>
                                <small>
                                    Detail Invalid
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </small>
                            </a>
                        </x-slot:action>
                    @endif
                @endif
            </x-cards.account-box>

            <!--Modal Detail Program-->
            @if ($isSpecialRegistration)
            <x-modals.zoomUp id="detailProgramLepas">
                <x-slot name="modalTitle">Detail Program</x-slot>
                <x-items.list-groups.basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Program</x-slot>
                        <x-slot name="subTitle">Mat Pilates</x-slot>
                    </x-items.list-groups.item-basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Coach</x-slot>
                        <x-slot name="subTitle">Coach Mala</x-slot>
                    </x-items.list-groups.item-basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Kelas</x-slot>
                        <x-slot name="subTitle">Senin, Rabu, Jum'at (10:00 - 11:00)</x-slot>
                    </x-items.list-groups.item-basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Jumlah Sesi</x-slot>
                        <x-slot name="subTitle">
                            1 Sesi
                        </x-slot>
                    </x-items.list-groups.item-basic>
                    <x-items.list-groups.item-basic>
                        <x-slot name="title">Pilihan Tanggal</x-slot>
                        <x-slot name="subTitle">
                            02 Desember 2024 <br/>
                            05 Desember 2024
                        </x-slot>
                    </x-items.list-groups.item-basic>
                </x-items.list-groups.basic>
            </x-modals.zoomUp>
            @endif
            <!--#Modal Detail Program-->
        </div>
        <!--#Detail Kelas Lepas-->

        <!--Modal Join Group WA Failed-->
        <x-modals.fadeInUp id="grupWa">
            <x-slot name="modalTitle">Upss.. Tidak Bisa Join Group WA</x-slot>
            <em class="text-danger">Anda bisa bergabung grup WA setelah status pembayaran anda dinyatakan "Valid"</em>
        </x-modals.fadeInUp>
        <!--#Modal Join Group WA Failed-->

        <!--Modal Invalid Payment-->
        <livewire:components.modals.invalid-payment modalId='invalidPayment' :$registrationId :$modalInvalidType/>
        <!--#Modal Invalid Payment-->

        <!--Code Referral-->
        <div class="col-lg-6 col-md-6 col-12 layout-spacing">
            <livewire:components.generate-referral-code />
        </div>
        <!--Code Referral-->

        {{-- Registrations Log --}}
        @if ($isRegisteredInReeactive)
            <div class="col-lg-6 col-md-6 col-12 layout-spacing">
                <x-cards.wallet>
                    <x-slot name="header">Pendaftaran Terkini Program Reguler</x-slot>
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
                            <div class="scroller2">
                                @foreach ($registrations as $register)
                                    @if ($loop->index <= 1)
                                    <x-items.list-groups.item-advance>
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
                            </div>
                        </x-items.list-groups.advance>
                </x-cards.wallet>
            </div>
        @endif


        @if ($isVoucherExist)
            <div class="col-lg-6 col-12 layout-spacing">
                <x-cards.wallet>
                    <x-slot:header>Voucher Merchandise - {{ $batchQuery->batch_name }}</x-slot:header>
                    <x-slot:mainTitle>
                        <div class="text-center">
                            {{ \SimpleSoftwareIO\QrCode\Facades\QrCode::size(130)->generate($linkVoucher) }}
                        </div>
                        <br/>
                        Tukar voucher dan dapatkan diskon sebesar <strong class="text-secondary">{{ \App\Helpers\CurrencyHelper::formatRupiah($batchQuery->merchandise_voucher) }}</strong> untuk setiap pembelian merchandise Reeactive
                    </x-slot:mainTitle>
                    <x-slot:info>
                        Status :
                        @if ($lastVoucherMerchandise->is_used == 1)
                            <x-items.badges.solid-danger>Sudah Digunakan</x-items.badges.solid-danger>
                        @else
                            <x-items.badges.solid-success>Belum Digunakan</x-items.badges.solid-success>
                        @endif
                        <br/>
                        Valid Sampai : {{ \Carbon\Carbon::parse($lastVoucherMerchandise->valid_date)->isoFormat('D MMM Y') }}</x-slot:info>
                    <x-slot:buttonActionOne>
                        <a href="{{ route('member::download_voucher_merchandise.create', Crypt::encrypt($lastVoucherMerchandise->id)) }}" target="_blank">
                            <x-buttons.solid-primary>Download</x-buttons.solid-primary>
                        </a>
                    </x-slot:buttonActionOne>
                    @if (session('error-id'))
                        <x-items.alerts.light-danger>{{ session('error-id') }}</x-items.alerts.light-danger>
                    @endif
                </x-cards.wallet>
            </div>
        @endif
    </div>
</div>
