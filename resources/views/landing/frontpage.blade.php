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

<!--== bootstrap -->
<link href="{{ asset('landing/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

<link href="https://fonts.googleapis.com/css?family=Young+Serif:300,400,500,600,700,800,900" rel="stylesheet">

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

<!--Color Theme-->
<link href="{{ asset('landing/css/theme-color/color-4.css') }}" rel="stylesheet" type="text/css" />

<style>
    .float {
        position: fixed;
        width: 45px;
        height: 45px;
        bottom: 20px;
        right: 20px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
    }

    .my-float {
        margin-top: 9px;
        margin-right: 9px;
        margin-bottom: 8px;
        margin-left: 10px;
    }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=628111777021" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

@livewireStyles
</head>

<body class="home-3" data-bs-spy="scroll" data-bs-target="#navbarNav">

<div class="page-wrapper">

    <!-- preloader start -->
    <div id="ht-preloader">
        <div class="loader clear-loader">
            <div class="loader-box"></div>
            <div class="loader-box"></div>
            <div class="loader-box"></div>
            <div class="loader-box"></div>
            <div class="loader-wrap-text">
            <div class="text">
                <img src="{{ asset('landing/images/small-logo.png') }}" width="35" height="35">
            </div>
            </div>
        </div>
    </div>
    <!-- preloader end -->

    <!--header start-->
    @include('landing.header')
    <!--header end-->

    <!--hero section start-->
    @include('landing.hero')
    <!--hero section end-->

    <!--body content start-->
    <div class="page-content">
        @yield('content')
    </div>
    <!--body content end-->

    <!--footer start-->
    @include('landing.footer')
    <!--footer end-->
</div>

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
