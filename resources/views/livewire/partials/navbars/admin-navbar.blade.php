<div>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow" wire:ignore.self>
        <div class="navbar-container d-flex justify-content-between">
            <!--Desktop Screen-->
            <ul class="nav navbar-nav align-items-center ms-auto d-none d-lg-block d-xl-block">
                <!--Avatar-->
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $firstName }} {{ $lastName }}</span>
                            <span class="user-status">{{ $roleName }}</span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"
                            alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="/ganti-password"><i class="me-50" data-feather="settings"></i>Password</a>
                        <a class="dropdown-item" href="/logout"><i class="me-50" data-feather="power"></i>Keluar</a>
                    </div>
                </li>
            </ul>
            <!--#Desktop Screen-->

            <!--Mobile Screen-->
            <ul class="nav navbar-nav align-items-center d-lg-none d-xl-none">
                <li class="nav-item nav-search">
                    {{-- @if (Route::is('finance::database_muzakki') || Route::is('finance::income_zakat'))
                        <a href="/">
                            <i class="ficon d-md-none d-lg-none d-xl-none" data-feather="arrow-left"></i>
                        </a>
                    @endif

                    <!--Menu Database Muzakki-->
                    @if (Route::is('finance::detail_muzakki'))
                        <a href="{{ route('finance::database_muzakki') }}" wire:navigate>
                            <i class="ficon d-md-none d-lg-none d-xl-none" data-feather="arrow-left"></i>
                        </a>
                    @endif

                    @if (Route::is('finance::form_edit_muzakki'))
                        <a href="#" onclick="history.back()">
                            <i class="ficon d-md-none d-lg-none d-xl-none" data-feather="arrow-left"></i>
                        </a>
                    @endif --}}
                    <!--#Menu Database Muzakki-->
                </li>
            </ul>

            <ul class="nav navbar-nav align-items-center d-lg-none d-xl-none">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name fw-bolder">{{ $firstName }} {{ $lastName }}</span>
                            <span class="user-status">{{ $roleName }}</span>
                        </div>
                        <span class="avatar">
                            <img class="round"
                            src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"
                            alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="/santri/profil"><b class="text-primary">{{ $firstName }} {{ $lastName }} ({{ $roleName }})</b> </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" wire:navigate href="{{ route('ganti_password') }}"><i class="me-50" data-feather="lock"></i>Password</a>
                        <a class="dropdown-item" href="/logout"><i class="me-50" data-feather="power"></i>Keluar</a>
                    </div>
                </li>
            </ul>
            <!--#Mobile Screen-->
        </div>
    </nav>
    <!-- END: Header-->
</div>
