<!DOCTYPE html>
<html lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="Lira">
    <title>{{ $title ?? 'Home' }} - Reeactive | Fit For Deen</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('style/app-assets/images/ico/faviconlaz.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/vendors.main.css') }}">
    @stack('vendorCss')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('style/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    @stack('pageCss')
    <!-- END: Page CSS-->

    {{-- Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('style/assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <!--Navbar-->
    @if (Auth::user()->role_id == 3)
        <livewire:partials.navbars.member-navbar />
    @elseif (Auth::user()->role_id == 2)
        <livewire:partials.navbars.coach-navbar />
    @else
        <livewire:partials.navbars.admin-navbar />
    @endif
    <!--#Navbar-->

    <!--Sidebar-->
    @if (Auth::user()->role_id == 3)
        @include('layouts.partials.sidebars.member-sidebar')
    @elseif (Auth::user()->role_id == 2)
        @include('layouts.partials.sidebars.coach-sidebar')
    @else
        @include('layouts.partials.sidebars.admin-sidebar')
    @endif
    <!--#Sidebar-->


    <!--Bottom Navbar-->
    @if (Auth::user()->role_id == 3)
        @include('layouts.partials.bottom_navbar.member-bottom-navbar')
    @elseif (Auth::user()->role_id == 2)
        @include('layouts.partials.bottom_navbar.coach-bottom-navbar')
    @else
        @include('layouts.partials.bottom_navbar.admin-bottom-navbar')
    @endif
    <!--#Bottom Navbar-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            {{ $slot }}
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('layouts.partials.footer')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('style/app-assets/vendors/js/vendors.min.js') }}" data-navigate-once></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @stack('vendorScripts')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('style/app-assets/js/core/app-menu.js') }}" data-navigate-once></script>
    <script src="{{ asset('style/app-assets/js/core/app.js') }}" data-navigate-once></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @stack('pageScripts')
    <!-- END: Page JS-->

    <script>
        document.addEventListener('livewire:navigated', () => {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    @livewireChartsScripts
</body>

</html>
