@extends('landing.frontpage')

@section('content')
    <!--About-->
    <section id="about" class="text-center position-relative wow fadeInUp" data-wow-duration="2s"
        data-bg-img="{{ asset('landing/images/pattern/03.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="section-title">
                        <h2 class="title">What We Do For <span class="text-theme">Your Fit</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="svg-container">
                    <svg id="svgC" width="100%" height="100%" viewBox="0 0 620 120"
                        preserveAspectRatio="xMidYMid meet"></svg>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="work-process">
                        <div class="box-loader"> <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="step-num-box">
                            <div class="step-icon"><span><i class="la la-lightbulb-o"></i></span>
                            </div>
                            <div class="step-num">01</div>
                        </div>
                        <div class="step-desc">
                            <h4>Educate</h4>
                            <p class="mb-0">Pemberian materi mengenai gerakan dasar, keseimbangan energi dan mitos-mitos
                                diet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                    <div class="work-process">
                        <div class="box-loader"> <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="step-num-box">
                            <div class="step-icon"><span><i class="la la-rocket"></i></span>
                            </div>
                            <div class="step-num">02</div>
                        </div>
                        <div class="step-desc">
                            <h4>Coaching</h4>
                            <p class="mb-0">Pelatihan olahraga yang berfokus pada strenght, cardio & flexibility</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                    <div class="work-process">
                        <div class="step-num-box">
                            <div class="step-icon"><span><i class="la la-check-square"></i></span>
                            </div>
                            <div class="step-num">03</div>
                        </div>
                        <div class="step-desc">
                            <h4>Maintenance</h4>
                            <p class="mb-0">Pengawasan pola makan, free consult with coach & support group member</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--#About-->

    <section id="service" class="position-relative overflow-hidden wow fadeInUp" data-wow-duration="2s"
        data-bg-img="{{ asset('landing/images/pattern/03.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 image-column right">
                    <img class="img-fluid" src="{{ asset('landing/images/banner/Vision.png') }}" alt="">
                </div>
                <div class="col-lg-6 col-md-12 me-auto">
                    <div class="featured-item style-5">
                        <div class="featured-icon">
                            <img class="img-fluid" src="{{ asset('landing/images/feature/03.png') }}" alt="">
                        </div>
                        <div class="featured-title">
                            <h5>Our Values</h5>
                        </div>
                        <div class="featured-desc">
                            <p>Menjaga fitrah perempuan sebagai muslimah yang taat untuk dapat bugar tanpa harus keluar
                                rumah,
                                bercampur-baur dengan lawan jenis dan mengumbar aurat
                            </p>
                        </div>
                    </div>
                    <div class="featured-item style-5 mt-3">
                        <div class="featured-icon">
                            <img class="img-fluid" src="{{ asset('landing/images/feature/07.png') }}" alt="">
                        </div>
                        <div class="featured-title">
                            <h5>Vision</h5>
                        </div>
                        <div class="featured-desc">
                            <p>Menciptakan komunitas muslimah yang bugar & kuat dalam menjalankan kewajibannya sebagai
                                pengurus rumah tangga, pencetak generasi robani & penyejuk mata suami
                            </p>
                        </div>
                    </div>
                    <div class="featured-item style-5 mt-3">
                        <div class="featured-icon">
                            <img class="img-fluid" src="{{ asset('landing/images/feature/05.png') }}" alt="">
                        </div>
                        <div class="featured-title">
                            <h5>Mission</h5>
                        </div>
                        <div class="featured-desc">
                            <p>Mengedukasi serta melatih muslimah untuk dapat membangun gaya hidup sehat dengan mengedepankan ilmu sains
                                yang up to date tanpa meninggalkan syariat islam
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
