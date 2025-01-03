<nav class="p-0 navbar navbar-light bg-light navbar-expand d-lg-none d-xl-none fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item active">
            <a href="{{ route('coach::dashboard') }}" class="text-center nav-link">
                <i data-feather='home' class="{{ Route::is('coach::dashboard') ? 'text-primary' : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('coach::dashboard') ? 'text-primary' : '' }}"><b>Home</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('coach::member_portal') }}" class="text-center nav-link">
                <i data-feather='users'
                    class="{{ Route::is('coach::member_portal') || Route::is('coach::active_members') || Route::is('coach::open_class_member')
                        ? 'text-primary'
                        : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('coach::member_portal') || Route::is('coach::active_members') || Route::is('coach::open_class_member')
                        ? 'text-primary'
                        : '' }}"><b>Member</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a wire:navigate href="{{ route('coach::class_room') }}" class="text-center nav-link">
                <i data-feather='layers'
                    class="{{ Route::is('coach::class_room')
                        ? 'text-primary'
                        : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('coach::class_room')
                        ? 'text-primary'
                        : '' }}"><b>Kelas</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('ganti_password') }}" class="text-center nav-link">
                <i data-feather='lock'
                    class="{{ Route::is('ganti_password')
                        ? 'text-primary'
                        : '' }}"></i>

                <span
                    class="small d-block {{ Route::is('ganti_password')
                        ? 'text-primary'
                        : '' }}"><b>Setting</b></span>
            </a>
        </li>
    </ul>
</nav>
