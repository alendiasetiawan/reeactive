<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('style/assets/') }}"
  data-template="vertical-menu-template-no-customizer"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $title }} - Reeactive | Fit For Deen</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('style/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> --}}
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/fontawesome.css') }}" data-navigate-track/>
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/tabler-icons.css') }}" data-navigate-track/>
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/flag-icons.css') }}" data-navigate-track/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/rtl/core.css') }}" data-navigate-track/>
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/rtl/theme-default.css') }}" data-navigate-track/>
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}" data-navigate-track/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" data-navigate-track/>
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/node-waves/node-waves.css') }}" data-navigate-track/>
    <link rel="stylesheet" href="{{ asset('style/assets/vendor/libs/typeahead-js/typeahead.css') }}" data-navigate-track/>
    @stack('vendorCss')

    <!-- Page CSS -->
    @stack('pageCss')
    <!-- Helpers -->
    <script src="{{ asset('style/assets/vendor/js/helpers.js') }}" data-navigate-track></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('style/assets/js/config.js') }}" data-navigate-track></script>

    @livewireStyles
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @if (Auth::user()->role_id == 3)
            @include('layouts.member.member_sidebar')
        @endif

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.navbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('breadcrumb')

                @yield('content')
            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('layouts.footer_page')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('style/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('style/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    @stack('vendorScript')

    <!-- Main JS -->
    <script src="{{ asset('style/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @stack('pageScript')

    @livewireScripts

  </body>
</html>
