@extends('landing.page')

@section('pageTitle')
    <section class="page-title overflow-hidden position-relative" data-bg-color="#fbf3ed">
        <canvas id="confetti"></canvas>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12">
                    <h1 class="title"><span>S</span>pecial Case Groups</h1>
                    <p>Program Khusus Yang Memiliki Masalah Medis Tertentu</p>
                </div>
                <div class="col-lg-5 col-md-12 text-lg-end mt-3 mt-lg-0">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="/#pricing">Pricelist</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Special Case Groups</li>
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
                <div class="col-12 mb-2">
                    <p>Dikhususkan bagi mereka yang qadarullah memiliki kondisi medis, di antaranya:
                        <b class="text-theme"><em>Cardiovascular (masalah jantung, paru & tekanan darah) & Riwayat Cidera Tulang-Otot-Sendi.</em></b>
                        Sebagai upaya untuk memberi fasilitas yang lebih baik agar member merasakan
                        pengalaman olahraga yang <b class="text-theme">efektif, efisien, dan aman</b> sehingga mencapai hasil yang
                        optimal.
                        Terhindar dari efek over train akibat program yang tidak sesuai di mana program umum dirancang untuk kondisi tubuh normal tanpa gejala cedera tulang-otot-sendi, maupun penyakit cardiovascular.
                    </p>
                </div>
                <div class="col-12">
                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                        <li>Program intensif 10 sesi</li>
                        <li>Latihan 2x seminggu (5 pekan) atau 3x seminggu (4 pekan)</li>
                        <li>Durasi latihan 40 - 60 menit</li>
                        <li>Menggunakan zoom premium</li>
                        <li>Jumlah peserta 4-6 orang</li>
                    </ul>
                </div>
                <div class="col-12">
                    <b class="text-theme"><u>Facilities</u></b>
                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                        <li>Support Whatsapp Groups</li>
                        <li>Assesment (Fitness test, Body Measurement)</li>
                        <li>Customized Program based on medical condition</li>
                        <li>Basic Macro Nutrient Education</li>
                        <li>Extra care from Elite Coach Team</li>
                        <li>Nutrition for Strenght Training Advice</li>
                        <li>Monitoring</li>
                        <li>Fitness & Diet Webinars</li>
                    </ul>
                </div>
            </div>
            <div class="row text-center mb-4">
                <h2 class="text-theme"><em>Rp 1.500.000/orang</em></h2>
            </div>
            <div class="row align-items-center">
                @foreach ($specialCaseCoaches as $coach)
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
