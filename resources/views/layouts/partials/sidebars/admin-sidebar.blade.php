<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    @include('layouts.partials.sidebars.brand')

    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="font-family: Poppins, serif">
            <li class="nav-item {{ Route::is('admin::dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin::dashboard') }}"><i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <!--DATABASE-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">DATABASE</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ Route::is('admin::database_member') ? 'active' : '' }}">
                <a wire:navigate class="d-flex align-items-center" href="{{ route('admin::database_member') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">Member Reguler</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin::request_class') ? 'active' : '' }}">
                <a wire:navigate class="d-flex align-items-center" href="{{ route('admin::request_class') }}">
                    <i data-feather="bookmark"></i>
                    <span class="menu-title text-truncate">Request Kelas</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="d-flex align-items-center" href="#"><i data-feather='layers'></i>
                    <span class="menu-title text-truncate">Kelas</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('admin::registration_quota') || Route::is('admin::member_in_class') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate
                            href="{{ route('admin::registration_quota') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Program Reguler</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin::lepasan_class') || Route::is('admin::participants_in_class') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate
                            href="{{ route('admin::lepasan_class') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Kelas Lepasan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--#DATABASE-->

            <!--REGISTRATION-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">REGISTRASI</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item ">
                <a class="d-flex align-items-center" href="#"><i data-feather='check-square'></i>
                    <span class="menu-title text-truncate">Verifikasi Transfer</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('admin::payment_verification') || Route::is('admin::payment_verification.show') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate
                            href="{{ route('admin::payment_verification') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Program Reguler</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin::lepasan_payment_verification') || Route::is('admin::detail_lepasan_payment') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate href="{{ route('admin::lepasan_payment_verification') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Kelas Lepasan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!---REGISTRATION-->

            <!--LOYALTI PROGRAM-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">PROGRAM LOYALTI</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ Route::is('admin::loyalty.membership.registered_by_referral') ? 'active' : '' }}">
                <a wire:navigate class="d-flex align-items-center" href="{{ route('admin::loyalty.membership.registered_by_referral') }}">
                    <i data-feather='check-square'></i>
                    <span class="menu-title text-truncate">Claim Referral</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('admin::loyalty.membership.merchandise_voucher_verification') ? 'active' : '' }}">
                <a wire:navigate class="d-flex align-items-center" href="{{ route('admin::loyalty.membership.merchandise_voucher_verification') }}">
                    <i data-feather='grid'></i>
                    <span class="menu-title text-truncate">Voc. Merchandise</span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="d-flex align-items-center" href="#"><i data-feather='star'></i>
                    <span class="menu-title text-truncate">Endorse</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('admin::loyalty.endorse.influencer') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate
                            href="{{ route('admin::loyalty.endorse.influencer') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Influencer</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin::loyalty.endorse.influencer_referral_code') ? 'active' : ''}}">
                        <a class="d-flex align-items-center" wire:navigate href="{{ route('admin::loyalty.endorse.influencer_referral_code') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Kode Referral</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!---LOYALTI PROGRAM-->

            <!--Settings-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">PENGATURAN</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ Route::is('admin::request_reset_password') ? 'active' : '' }}">
                <a wire:navigate class="d-flex align-items-center" href="{{ route('admin::request_reset_password') }}">
                    <i data-feather="lock"></i>
                    <span class="menu-title text-truncate">Reset Password</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="/logout">
                    <i data-feather="log-out"></i>
                    <span class="menu-title text-truncate">Keluar</span>
                </a>
            </li>
            <!--#Settings-->
        </ul>
    </div>

</div>
