<nav class="p-0 navbar navbar-light bg-light navbar-expand d-lg-none d-xl-none fixed-bottom">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item active">
            <a href="{{ route('member::dashboard') }}" class="text-center nav-link">
                <i data-feather='home' class="{{ Route::is('member::dashboard') ? 'text-primary' : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('member::dashboard') ? 'text-primary' : '' }}"><b>Home</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('member::registration_portal') }}" class="text-center nav-link">
                <i data-feather='file-text'
                    class="{{ Route::is('member::renewal_registration') || Route::is('member::renewal_registration.show') || Route::is('member::registration_portal')
                        ? 'text-primary'
                        : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('member::renewal_registration') || Route::is('member::renewal_registration.show') || Route::is('member::registration_portal')
                        ? 'text-primary'
                        : '' }}"><b>Registrasi</b></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('member::referral_member') }}" class="text-center nav-link">
                <i data-feather='user-plus'
                    class="{{ Route::is('member::referral_member')
                        ? 'text-primary'
                        : '' }}"></i>
                <span
                    class="small d-block {{ Route::is('member::referral_member')
                        ? 'text-primary'
                        : '' }}"><b>Referral</b></span>
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
