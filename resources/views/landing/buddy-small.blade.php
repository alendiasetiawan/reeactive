@extends('landing.page')

@section('pageTitle')
    <section class="page-title overflow-hidden position-relative" data-bg-color="#fbf3ed">
        <canvas id="confetti"></canvas>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>B</span>uddy/Small Groups</h1>
                    <p>Program Intensif Untuk Kelompok Kecil</p>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="/#pricing">Pricelist</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Buddy/Small Groups</li>
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
            <!--Program Buddy-->
            <div class="row text-center mb-3">
                <h2 class="title">Program <span class="text-theme">Buddy</span></h2>
            </div>
            <div class="row align-items-center">
                @foreach ($buddyCoaches as $buddy)
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 ms-auto mb-5">
                        <div class="section-title mb-3">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div> <i class="la la-info"></i>
                            </div>
                            <h2>Coach {{ $buddy->nick_name }}</h2>
                            <h4>{{ 'Rp '.number_format($buddy->price,0,',','.') }}/2 Orang</h4>
                            <h4>({{ 'Rp '.number_format($buddy->price_per_person,0,',','.') }}/Orang)</h4>
                        </div>
                        <p class="lead">
                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                @foreach ($buddy->coach_skills as $skill)
                                    <li>{{ $skill->skill_name }}</li>
                                @endforeach
                            </ul>
                        </p>
                        <b class="text-theme">Certificates</b>
                        <br>
                        <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                            @foreach ($buddy->coach_certificates as $certificate)
                                <li>{{ $certificate->certificate_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <!--#Program Buddy-->

            <!--Program Small Groups-->
            <div class="row text-center mb-3">
                <h2 class="title">Program <span class="text-theme">Small Groups</span></h2>
            </div>
            <div class="row align-items-center">
                @foreach ($smallCoaches as $small)
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 ms-auto mb-5">
                        <div class="section-title mb-3">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div> <i class="la la-info"></i>
                            </div>
                            <h2>Coach {{ $small->nick_name }}</h2>
                            <h4>{{ 'Rp '.number_format($small->price,0,',','.') }}/4 Orang</h4>
                            <h4>({{ 'Rp '.number_format($small->price_per_person,0,',','.') }}/orang)</h4>
                        </div>
                        <p class="lead">
                            <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                @foreach ($small->coach_skills as $skill)
                                    <li>{{ $skill->skill_name }}</li>
                                @endforeach
                            </ul>
                        </p>
                        <b class="text-theme">Certificates</b>
                        <br>
                        <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                            @foreach ($small->coach_certificates as $certificate)
                                <li>{{ $certificate->certificate_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <!--#Program Small Groups-->
        </div>
    </section>
@endsection
