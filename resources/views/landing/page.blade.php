<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="bootstrap 5, premium, multipurpose, sass, scss, saas, software" />
    <meta name="description" content="HTML5 Template" />
    <meta name="author" content="www.themeht.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>{{ $title }} - Reeactive | Fit For Deen</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('landing/images/favicon.ico') }}" />

    <!-- inject css start -->

    <!--== bootstrap -->
    <link href="{{ asset('landing/') }}" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!--== animate -->
    <link href="{{ asset('landing/css/animate.css') }}" rel="stylesheet" type="text/css" />

    <!--== fontawesome -->
    <link href="{{ asset('landing/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css" />

    <!--== line-awesome -->
    <link href="{{ asset('landing/css/line-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <!--== magnific-popup -->
    <link href="{{ asset('landing/css/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <!--== owl-carousel -->
    <link href="{{ asset('landing/css/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />

    <!--== base -->
    <link href="{{ asset('landing/css/base.css') }}" rel="stylesheet" type="text/css" />

    <!--== shortcodes -->
    <link href="{{ asset('landing/css/shortcodes.css') }}" rel="stylesheet" type="text/css" />

    <!--== default-theme -->
    <link href="{{ asset('landing/css/style.css') }}" rel="stylesheet" type="text/css" />

    <!--== responsive -->
    <link href="{{ asset('landing/css/responsive.css') }}" rel="stylesheet" type="text/css" />

    <!-- inject css end -->
    @livewireStyles
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarNav">

    <!-- page wrapper start -->

    <div class="page-wrapper">

        <!--header start-->
        @include('landing.header-page')
        <!--header end-->


        <!--page title start-->
        @yield('pageTitle')
        <!--page title end-->


        <!--body content start-->
        <div class="page-content">
            @yield('content')
        </div>
        <!--body content end-->


        <!--footer start-->
        @include('landing.footer')
        <!--footer end-->
    </div>
    <!-- page wrapper end -->



    <!-- inject js start -->

    <!--== jquery -->
    <script src="{{ asset('landing/js/theme.js') }}"></script>

    <!--== owl-carousel -->
    <script src="{{ asset('landing/js/owl-carousel/owl.carousel.min.js') }}"></script>

    <!--== magnific-popup -->
    <script src="{{ asset('landing/js/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!--== counter -->
    <script src="{{ asset('landing/js/counter/counter.js') }}"></script>

    <!--== countdown -->
    <script src="{{ asset('landing/js/countdown/jquery.countdown.min.js') }}"></script>

    <!--== canvas -->
    <script src="{{ asset('landing/js/canvas.js') }}"></script>

    <!--== confetti -->
    <script src="{{ asset('landing/js/confetti.js') }}"></script>

    <!--== step animation -->
    <script src="{{ asset('landing/js/snap.svg.js') }}"></script>
    <script src="{{ asset('landing/js/step.js') }}"></script>

    <!--== contact-form -->
    <script src="{{ asset('landing/js/contact-form/contact-form.js') }}"></script>

    <!--== wow -->
    <script src="{{ asset('landing/js/wow.min.js') }}"></script>

    <!--== theme-script -->
    <script src="{{ asset('landing/js/theme-script.js') }}"></script>

    <!-- inject js end -->
    @livewireScripts
</body>

</html>
