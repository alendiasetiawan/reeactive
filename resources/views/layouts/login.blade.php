<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Halaman Login | Reeactive - Fit For Deen </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('template/src/assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('template/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/authentication/auth-cover.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('template/layouts/modern-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('template/src/assets/css/dark/authentication/auth-cover.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--CUSTOM STYLE-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/dark/elements/alert.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/loaders/custom-loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/css/dark/loaders/custom-loader.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="form">

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>

                    <div class="position-relative">

                        <img src="{{ asset('template/src/assets/img/logo/reeactive-3d.png') }}" alt="auth-img">

                        <h2 class="mt-5 text-white font-weight-bolder px-2">FIT FOR DEEN
                        </h2>
                        <p class="text-white px-2">Mari bergabung bersama komunitas bugar muslimah di seluruh penjuru dunia</p>
                    </div>

                </div>

                <div
                    class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <h2>Login Aplikasi</h2>
                                        <p>Ayo masuk dan mulai perjalanan "Fit for Deen" kamu</p>

                                    </div>
                                    <div class="col-12 mb-3">
                                        <!--PESAN GAGAL LOGIN-->
                                        @if (\Session::has('flash_message_error'))
                                        <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                            <strong>{!! session('flash_message_error') !!}</strong>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <x-inputs.label>Username</x-inputs.label>
                                            <input class="form-control" type="text" name="email" autofocus required
                                            @if(\Cookie::has('saveuser')) value="{{ \Cookie::get('saveuser') }}" @endif/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <x-inputs.label>Password</x-inputs.label>
                                            <input type="password" class="form-control" name="password" required
                                            @if(\Cookie::has('savepwd')) value="{{ \Cookie::get('savepwd') }}" @endif />
                                        </div>
                                    </div>
                                    <div class="col-12">

                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-1" type="checkbox"
                                                    id="remember-me" name="simpanpwd" @if(\Cookie::has('saveuser')) checked @endif>
                                                <label class="form-check-label" for="form-check-default">
                                                    Simpan Password
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button class="btn btn-secondary w-100" type="submit"
                                            onclick="this.disabled=true;this.form.submit();">LOGIN</button>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="text-center">
                                            <p class="mb-0">Belum menjadi member? <a href="javascript:void(0);"
                                                    class="text-warning">Daftar Sekarang</a></p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <p class="mb-0"><a href="/"><b class="text-primary">Beranda</b></a> | <a href="https://wa.me/628111777021"><b class="text-primary">Kontak</b></a></p>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('template/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

</body>

</html>
