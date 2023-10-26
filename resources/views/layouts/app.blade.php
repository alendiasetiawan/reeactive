<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? 'Home' }} - Reeactive | Fit For Deen </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/src/assets/img/favicon.ico') }}"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('template/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @stack('customCss')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @livewireStyles()
    <script src="https://kit.fontawesome.com/69d31acf39.js" crossorigin="anonymous"></script>
    <wireui:scripts />
</head>
<body class="layout-sidebar">
    <!--Query For Checking User Data-->
    @php
        $fullName = Auth::user()->full_name;
        $user = DB::table('users')
        ->join('roles', 'users.role_id', 'roles.id')
        ->where('email', Auth::user()->email)
        ->first();
    @endphp
    <!--#Query For Checking User Data-->

    <!--  BEGIN NAVBAR  -->
    @if (Auth::user()->role_id == 1)
        @include('layouts.elements.headers.admin_header')
    @elseif (Auth::user()->role_id == 2)
        @include('layouts.elements.headers.coach_header')
    @else
        @include('layouts.elements.headers.member_header')
    @endif

    @if (Auth::user()->role_id == 1)
        @include('layouts.elements.bottom_navbar.admin_bottom_navbar')
    @elseif (Auth::user()->role_id == 2)
        @include('layouts.elements.bottom_navbar.coach_bottom_navbar')
    @else
        @include('layouts.elements.bottom_navbar.member_bottom_navbar')
    @endif


    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @if (Auth::user()->role_id == 3)
            @include('layouts.elements.sidebars.member_sidebar')
        @elseif (Auth::user()->role_id == 2)
            @include('layouts.elements.sidebars.coach_sidebar')
        @else
            @include('layouts.elements.sidebars.admin_sidebar')
        @endif
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">
                    {{-- @yield('breadcrumb')

                    @yield('content') --}}
                    {{ $slot }}
                </div>

            </div>

            @include('layouts.elements.footer')

        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('template/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('template/src/bootstrap/js/bootstrap.main.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/mousetrap/mousetrap.main.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/waves/waves.main.js') }}"></script>
    <script src="{{ asset('template/layouts/modern-light-menu/app.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/highlight/highlight.pack.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @stack('customScripts')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @livewireScripts()
</body>
</html>
