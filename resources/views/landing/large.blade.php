@extends('landing.page')

@section('pageTitle')
    <section class="page-title overflow-hidden position-relative" data-bg-color="#fbf3ed">
        <canvas id="confetti"></canvas>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>L</span>arge Groups</h1>
                    <p>Program Intensif Untuk Kelompok Besar</p>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="/#pricing">Pricelist</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Large Groups</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="bg-effect position-relative custom-py-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                        <li>Program intensif 10 pekan</li>
                        <li>Latihan 3x per pekan</li>
                        <li>Durasi latihan 40 - 60 menit</li>
                        <li>Menggunakan zoom premium</li>
                        <li>Jumlah maksimal peserta 15 orang</li>
                    </ul>
                </div>
            </div>
            <div class="row text-center mb-4">
                <h2 class="text-theme"><em>Rp 1.350.000/orang</em></h2>
            </div>
            <div class="row align-items-center">
                @foreach ($largeCoaches as $coach)
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 ms-auto mb-5">
                        <div class="section-title mb-3">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div> <i class="la la-info"></i>
                            </div>
                            <h2>Coach {{ $coach->nick_name }}</h2>
                        </div>
                        <p class="lead">
                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                @foreach ($coach->coach_skills as $skill)
                                    <li>{{ $skill->skill_name }}</li>
                                @endforeach
                            </ul>
                        </p>
                        <b class="text-theme">Certificates</b><br>
                        <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                            @foreach ($coach->coach_certificates as $certificate)
                                <li>{{ $certificate->certificate_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
