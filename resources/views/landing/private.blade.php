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
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
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
                @foreach ($coachs as $coach)
                    <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 ms-auto">
                        <div class="section-title mb-3">
                            <div class="title-effect title-effect-2">
                                <div class="ellipse"></div> <i class="la la-info"></i>
                            </div>
                            <h2>We're Building Modern And High Software</h2>
                        </div>
                        <p class="lead">Deos et accusamus et iusto odio dignissimos qui blanditiis praesentium voluptatum dele
                            corrupti quos dolores et quas molestias a orci facilisis rutrum.</p>
                        <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                            <li>Design must be functional</li>
                            <li>Futionality must into</li>
                            <li>Aenean pellentes vitae</li>
                            <li>Mattis effic iturut magna</li>
                            <li>Lusce enim nulla mollis</li>
                            <li>Phasellus eget felis</li>
                        </ul>
                    </div>
                @endforeach

                <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 ms-auto">
                    <div class="section-title mb-3">
                        <div class="title-effect title-effect-2">
                            <div class="ellipse"></div> <i class="la la-info"></i>
                        </div>
                        <h2>We're Building Modern And High Software</h2>
                    </div>
                    <p class="lead">Deos et accusamus et iusto odio dignissimos qui blanditiis praesentium voluptatum dele
                        corrupti quos dolores et quas molestias a orci facilisis rutrum.</p>
                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                        <li>Design must be functional</li>
                        <li>Futionality must into</li>
                        <li>Aenean pellentes vitae</li>
                        <li>Mattis effic iturut magna</li>
                        <li>Lusce enim nulla mollis</li>
                        <li>Phasellus eget felis</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
