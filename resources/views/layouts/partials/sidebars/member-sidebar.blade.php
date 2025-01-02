<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    @include('layouts.partials.sidebars.brand')

    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="font-family: Poppins, serif">
            <li class="nav-item {{ Route::is('member::dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('member::dashboard') }}"><i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <!--Member Area-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">MEMBER AREA</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ Route::is('member::renewal_registration') || Route::is('member::open_class_registration') || Route::is('member::registration_portal') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('member::dashboard') }}"><i data-feather="file-text"></i>
                    <span class="menu-title text-truncate">Registrasi</span>
                </a>
            </li>
            <!--#Member Area-->

            <!--Program Reeactive-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">PROGRAM REEACTIVE</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ Route::is('member::referral_member') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('member::referral_member') }}">
                    <i data-feather="user-plus"></i>
                    <span class="menu-title text-truncate">Referral Member</span>
                </a>
            </li>
            <!--#Program Reeactive-->

            <!--Settings-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">PENGATURAN</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item {{ Route::is('ganti_password') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('ganti_password') }}">
                    <i data-feather="lock"></i>
                    <span class="menu-title text-truncate">Password</span>
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
