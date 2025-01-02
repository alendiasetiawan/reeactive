<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    @include('layouts.partials.sidebars.brand')

    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="font-family: Poppins, serif">
            <li class="nav-item {{ Route::is('coach::dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('coach::dashboard') }}"><i data-feather="home"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>

            <!--DATABASE-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">DATABASE</span><i data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item ">
                <a class="d-flex align-items-center" href="#"><i data-feather='users'></i>
                    <span class="menu-title text-truncate">Member</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Route::is('coach::active_members') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate
                            href="{{ route('coach::active_members') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Kelas Reguler</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('coach::open_class_member') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" wire:navigate
                            href="{{ route('coach::open_class_member') }}"><i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Kelas Lepasan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ Route::is('coach::class_room') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('coach::class_room') }}">
                    <i data-feather="clock"></i>
                    <span class="menu-title text-truncate">Kelas</span>
                </a>
            </li>
            <!--#DATABASE-->

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
