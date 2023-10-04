@extends('landing.page')

@section('pageTitle')
    <section class="page-title overflow-hidden position-relative" data-bg-color="#fbf3ed">
        <canvas id="confetti"></canvas>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>P</span>rivate 1 on 1</h1>
                    <p>Program Intensif Face to Face Dengan Coach</p>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="/#pricing">Pricelist</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Private 1 on 1</li>
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
            <div class="row align-items-center">
                @foreach ($coaches as $coach)
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 ms-auto mb-5">
                        <div class="section-title mb-3">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div> <i class="la la-info"></i>
                            </div>
                            <h2>Coach {{ $coach->nick_name }} ({{ 'Rp '.number_format($coach->price,0,',','.') }})</h2>
                            <small>{{ $coach->coach_name }}</small>
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
