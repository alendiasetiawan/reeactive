<nav class="p-0 navbar navbar-light bg-light navbar-expand d-lg-none d-xl-none fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item active">
            <a href="{{ route('admin::dashboard') }}" class="text-center nav-link">
                <i data-feather='home' class="{{ Route::is('admin::dashboard') ? 'text-primary' : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('admin::dashboard') ? 'text-primary' : '' }}"><b>Home</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('admin::landing_payment_verification') }}" class="text-center nav-link">
                <i data-feather='credit-card' class="{{ Route::is('admin::landing_payment_verification') || Route::is('admin::payment_verification.show') || Route::is('admin::payment_verification') || Route::is('admin::lepasan_payment_verification') || Route::is('admin::detail_lepasan_payment') ? 'text-primary' : '' }}"></i>
                <span class="small d-block {{ Route::is('admin::landing_payment_verification') || Route::is('admin::payment_verification.show') || Route::is('admin::payment_verification') || Route::is('admin::lepasan_payment_verification') || Route::is('admin::detail_lepasan_payment') ? 'text-primary' : '' }}">
                    <b>Transfer</b>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('admin::database_member') }}" class="text-center nav-link">
                <i data-feather='users' class="{{ Route::is('admin::database_member') ? 'text-primary' : '' }}"></i>
                <span class="small d-block {{ Route::is('admin::database_member') ? 'text-primary' : '' }}">
                    <b>Member</b>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('admin::landing_class_room') }}" class="text-center nav-link">
                <i data-feather='layers' class="{{ Route::is('admin::landing_class_room') || Route::is('admin::lepasan_class') || Route::is('admin::registration_quota') || Route::is('admin::member_in_class') || Route::is('admin::participants_in_class') ? 'text-primary' : '' }}"></i>
                <span class="small d-block {{ Route::is('admin::landing_class_room') || Route::is('admin::lepasan_class') || Route::is('admin::registration_quota') || Route::is('admin::member_in_class') || Route::is('admin::participants_in_class') ? 'text-primary' : '' }}">
                    <b>Kelas</b>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link menu-toggle" href="#">
                <i class="ficon" data-feather="menu"></i>
                <span class="small d-block"><b>Menu</b></span>
            </a>
        </li>
    </ul>
</nav>
