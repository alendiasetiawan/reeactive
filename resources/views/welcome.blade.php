@extends('landing.frontpage')

@section('content')
    <!--About-->
    <section id="about" class="text-center position-relative overflow-hidden wow fadeInUp" data-wow-duration="3s" data-bg-img="{{ asset('landing/images/pattern/03.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="section-title">
                        <h2 class="title">What <span class="text-theme">We Do</span></h2>
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
                            <div class="step-icon"><span><i class="la la-book"></i></span>
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
                            <div class="step-icon"><span><i class="la la-stopwatch"></i></span>
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
                            <div class="step-icon"><span><i class="la la-balance-scale"></i></span>
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

    <section class="position-relative overflow-hidden wow fadeInUp" data-wow-duration="2s">
        <div class="bg-animation">
            <img class="zoom-fade" src="{{ asset('landing/images/pattern/03.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid" src="{{ asset('landing/images/banner/goal.webp') }}" alt="">
                </div>
                <div class="col-lg-6 me-auto">
                    <div class="featured-item style-5">
                        <div class="featured-icon">
                            <img class="img-fluid" src="{{ asset('landing/images/feature/value.png') }}" alt="">
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
                            <img class="img-fluid" src="{{ asset('landing/images/feature/vision.png') }}" alt="">
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
                            <img class="img-fluid" src="{{ asset('landing/images/feature/mission.png') }}" alt="">
                        </div>
                        <div class="featured-title">
                            <h5>Mission</h5>
                        </div>
                        <div class="featured-desc">
                            <p>Mengedukasi serta melatih muslimah untuk dapat membangun gaya hidup sehat dengan
                                mengedepankan ilmu sains
                                yang up to date tanpa meninggalkan syariat islam
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Programs-->
    <section id="program" class="service position-relative bg-effect overflow-hidden wow fadeInUp" data-wow-duration="2s">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <div class="section-title">
                        <div class="title-effect title-effect-2">
                            <div class="ellipse"></div> <i class="la la-dumbbell"></i>
                        </div>
                        <h2 class="title">Our <span class="text-theme">Programs</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 order-lg-0 image-column right">
                    <img class="img-fluid z-index-1 w-100" src="{{ asset('landing/images/banner/program.webp') }}"
                        alt="">
                </div>
                <div class="col-lg-6 col-md-12 mt-5 mt-lg-0 order-lg-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="featured-item style-3">
                                <div class="featured-icon">
                                    <i class="la la-user-circle"></i>
                                </div>
                                <div class="featured-title">
                                    <h5>Private Class</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>
                                        1. Offline/Home Visit (Area Jakarta Selatan & Bandung Raya) <br>
                                        2. Online
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-4">
                            <div class="featured-item style-3">
                                <div class="featured-icon">
                                    <i class="la la-user-friends"></i>
                                </div>
                                <div class="featured-title">
                                    <h5>Buddy/Small Group</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>
                                        1. Offline/Home Visit (Area Jakarta Selatan & Bandung Raya) <br>
                                        2. Online
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-3 mt-md-0">
                            <div class="featured-item style-3">
                                <div class="featured-icon">
                                    <i class="la la-users"></i>
                                </div>
                                <div class="featured-title">
                                    <h5>Group Class</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>
                                        Online integrated programs : <br>
                                        1. Special Case 0.5 <br>
                                        2. Beginner 1.0 <br>
                                        3. Beginner 2.0 <br>
                                        4. Intermediate
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mt-4">
                            <div class="featured-item style-3">
                                <div class="featured-icon">
                                    <i class="la la-heartbeat"></i>
                                </div>
                                <div class="featured-title">
                                    <h5>Nutritionist Consultation</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>
                                        Konsultasi dengan ahli gizi untuk menentukan pola makan yang tepat & sesuai dengan
                                        goals.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--#Programs-->

    <!--Pricelist-->
    <section id="pricing" class="position-relative overflow-hidden wow fadeInUp" data-wow-duration="2s">
        <div class="row text-center">
            <div class="col-lg-6 col-md-10 mx-auto">
                <div class="section-title">
                    <div class="title-effect title-effect-2">
                        <div class="ellipse"></div> <i class="la la-wallet"></i>
                    </div>
                    <h2 class="title">Our <span class="text-theme">Price Lists</span></h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="tab style-2">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-tab1" data-bs-toggle="tab" href="#tab1-1"
                                    role="tab" aria-selected="true"> <i class="la la-user-circle"></i>
                                    <h5>Private 1 on 1</h5>
                                </a>
                                <a class="nav-item nav-link" id="nav-tab2" data-bs-toggle="tab" href="#tab1-2"
                                    role="tab" aria-selected="false"><i class="la la-user-friends"></i>
                                    <h5>Buddy-Small Group</h5>
                                </a>
                                <a class="nav-item nav-link" id="nav-tab3" data-bs-toggle="tab" href="#tab1-3"
                                    role="tab" aria-selected="false"><i class="la la-user-injured"></i>
                                    <h5>Special Case Small Group</h5>
                                </a>
                                <a class="nav-item nav-link" id="nav-tab4" data-bs-toggle="tab" href="#tab1-4"
                                    role="tab" aria-selected="false"><i class="la la-users"></i>
                                    <h5>Large Group</h5>
                                </a>
                                <a class="nav-item nav-link" id="nav-tab5" data-bs-toggle="tab" href="#tab1-5"
                                    role="tab" aria-selected="false"><i class="la la-heartbeat"></i>
                                    <h5>Nutritionist Consultation</h5>
                                </a>
                            </div>
                        </nav>
                        <!-- Tab panes -->
                        <hr />
                        <div class="tab-content" id="nav-tabContent">
                            <!--Private-->
                            <div role="tabpanel" class="tab-pane fade show active" id="tab1-1">
                                <div class="row align-items-center">
                                    @foreach ($privatePrograms as $program)
                                        @if ($loop->index <= 3)
                                            <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                                <h4 class="mb-2">{{ $loop->iteration }}.Coach {{ $program->nick_name }}
                                                    <span class="text-theme">(Online
                                                        {{ 'Rp ' . number_format($program->price, 0, ',', '.') }})</span>
                                                </h4>
                                                <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                    @foreach ($program->coach_skills as $skill)
                                                        <li>{{ $skill->skill_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="btn btn-theme" href="/private-1-on-1" data-text="Read More">
                                    <span>D</span><span>e</span><span>t</span><span>a</span><span>i</span><span>l</span>
                                </a>
                            </div>
                            <!--#Private-->

                            <!--Buddy-Small-->
                            <div role="tabpanel" class="tab-pane fade" id="tab1-2">
                                <b class="text-theme"><u>Buddy Groups : 2 Orang</u></b> <br>
                                <div class="row align-items-center mt-1">
                                    @foreach ($buddyPrograms as $program)
                                        @if ($loop->index <= 1)
                                            <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                                <h4 class="mb-2">{{ $loop->iteration }}. Coach
                                                    {{ $program->nick_name }}
                                                    <span class="text-theme">(Online
                                                        {{ 'Rp ' . number_format($program->price, 0, ',', '.') }}/2
                                                        orang)</span>
                                                </h4>
                                                <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                    @foreach ($program->coach_skills as $skill)
                                                        <li>{{ $skill->skill_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <b class="text-theme"><u>Small Groups : 4 - 6 Orang</u></b> <br>
                                <div class="row align-items-center mt-1">
                                    @foreach ($smallPrograms as $program)
                                        @if ($loop->index <= 1)
                                            <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                                <h4 class="mb-2">{{ $loop->iteration }}. Coach
                                                    {{ $program->nick_name }}
                                                    <span class="text-theme">(Online
                                                        {{ 'Rp ' . number_format($program->price, 0, ',', '.') }}/4
                                                        orang)</span>
                                                </h4>
                                                <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                    @foreach ($program->coach_skills as $skill)
                                                        <li>{{ $skill->skill_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="btn btn-theme" href="/buddy-small-groups" data-text="Read More">
                                    <span>D</span><span>e</span><span>t</span><span>a</span><span>i</span><span>l</span>
                                </a>
                            </div>
                            <!--#Buddy-Small-->

                            <!--Special Groups-->
                            <div role="tabpanel" class="tab-pane fade" id="tab1-3">
                                <div class="row text-center mb-4">
                                    <h3 class="text-theme"><em>Rp 1.500.000/orang</em></h3>
                                </div>
                                <div class="row">
                                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                        <li>Program intensif 10 sesi</li>
                                        <li>Latihan 2x seminggu (5 pekan) atau 3x seminggu (4 pekan)</li>
                                        <li>Durasi latihan 40 - 60 menit</li>
                                        <li>Menggunakan zoom premium</li>
                                        <li>Jumlah peserta 4-6 orang</li>
                                    </ul>
                                </div>
                                <div class="row align-items-center">
                                    @foreach ($specialPrograms as $program)
                                        @if ($loop->index <= 3)
                                            <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                                <h4 class="mb-2">{{ $loop->iteration }}. Coach
                                                    {{ $program->nick_name }}
                                                </h4>
                                                <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                    @foreach ($program->coach_skills as $skill)
                                                        <li>{{ $skill->skill_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="btn btn-theme" href="/special-case-groups" data-text="Read More">
                                    <span>D</span><span>e</span><span>t</span><span>a</span><span>i</span><span>l</span>
                                </a>
                            </div>
                            <!--Special Groups-->

                            <!--Large Groups-->
                            <div role="tabpanel" class="tab-pane fade" id="tab1-4">
                                <div class="row text-center mb-4">
                                    <h3 class="text-theme"><em>Rp 1.350.000/orang</em></h3>
                                </div>
                                <div class="row">
                                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                        <li>Program intensif 10 pekan</li>
                                        <li>Latihan 3x per pekan</li>
                                        <li>Durasi latihan 40 - 60 menit</li>
                                        <li>Menggunakan Zoom Premium atau Google Meet</li>
                                        <li>Jumlah maksimal peserta 15 orang</li>
                                    </ul>
                                </div>
                                <div class="row align-items-center">
                                    @foreach ($largePrograms as $program)
                                        @if ($loop->index <= 3)
                                            <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                                <h4 class="mb-2">{{ $loop->iteration }}. Coach
                                                    {{ $program->nick_name }}
                                                </h4>
                                                <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                                    @foreach ($program->coach_skills as $skill)
                                                        <li>{{ $skill->skill_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a class="btn btn-theme" href="/large-groups" data-text="Read More">
                                    <span>D</span><span>e</span><span>t</span><span>a</span><span>i</span><span>l</span>
                                </a>
                            </div>
                            <!--#Large Groups-->

                            <!--Nutritionist-->
                            <div role="tabpanel" class="tab-pane fade" id="tab1-5">
                                <div class="row text-center mb-4">
                                    <h3 class="text-theme"><em>Rp 450.000/bulan</em></h3>
                                </div>
                                <div class="row">
                                    <b class="text-theme">Facilities</b>
                                    <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                        <li>Konseling</li>
                                        <li>Assesment</li>
                                        <li>Personalized Diet Program</li>
                                        <li>Meal Plan</li>
                                        <li>Free Consultation via Whatsapp</li>
                                        <li>Basic Macro Nutrient Education</li>
                                    </ul>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                        <h4 class="mb-2">1. Milla Meila Asty, AMG
                                        </h4>
                                        <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                            <li>Certified Registered Nutritionist</li>
                                            <li>Ahli Gizi Klinik di RS</li>
                                            <li>Certified Nutritional Care Process
                                                Basic & Advance by ASDI</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mt-3 mt-lg-0">
                                        <h4 class="mb-2">2. Tiara Baidhazain, S.T r.GZ
                                        </h4>
                                        <ul class="custom-li list-unstyled list-icon-2 d-inline-block">
                                            <li>Workshop Gizi Olahraga &
                                                Prestasi by ISNA</li>
                                            <li>Diabetic Care by Persatuan
                                                Diabetes Indonesia</li>
                                            <li>Certified Nutritionist Registered</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--#Nutritionist-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--#Pricelist-->

    <!--Testimonials-->
    <section id="testimoni" class="position-relative overflow-hidden" data-bg-img="{{ asset('landing/images/pattern/01.png') }}">
        <canvas id="confetti"></canvas>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-12">
                    <div class="section-title">
                        <div class="title-effect title-effect-2">
                            <div class="ellipse"></div> <i class="la la-comment"></i>
                        </div>
                        <h2 class="title">Our <span class="text-theme">Satisfied Members</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel" data-items="3" data-sm-items="1" data-margin="50" data-autoplay="true">
                        <div class="item">
                            <div class="testimonial style-4">
                                <div class="testimonial-content">
                                    <div class="testimonial-quote"><i class="la la-quote-left"></i>
                                    </div>
                                    <p>Baarakallahu fiikum utk semua team reeactive yg sudah memfasilitasi kami sbg akhwat utk  bisa workout  dgn menjaga fitrah tetap di rumah. 🤍
                                        Alhamdulillah, Bi'idznillah promilku sbg pengidap pcos,  berhasil setelah ikhtiar  mengikuti program reeactive. Jazaakumullahu khayran 🤍
                                    </p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="img-fluid zoom-fade" src="{{ asset('landing/images/team/founder.png') }}" alt="">
                                </div>
                                <div class="testimonial-caption">
                                    <h5>Maryam Fithriyyah</h5>
                                    <label>Batch 7</label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial style-4">
                                <div class="testimonial-content">
                                    <div class="testimonial-quote"><i class="la la-quote-left"></i>
                                    </div>
                                    <p>Alhamdulillah masya Allah coach rahayu selalu sabar dan perhatian ke tiap member ditambah juga asik lucu jadi ga tegang. Qodarullah  lingkar pinggang dan bagian tubuh lainnya mengecil. BB juga menurun. Badan makin sehat makin fit dibuat kegiatan banyak gak gampang capek. Semoga kedepannya coach rahayu makin perhatiin detil gerakan tiap member dan makin banyak ilmu baru</p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="img-fluid zoom-fade" src="{{ asset('landing/images/team/finance.png') }}" alt="">
                                </div>
                                <div class="testimonial-caption">
                                    <h5>Anjani</h5>
                                    <label>Batch 7</label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial style-4">
                                <div class="testimonial-content">
                                    <div class="testimonial-quote"><i class="la la-quote-left"></i>
                                    </div>
                                    <p>Alhamdulillah pelajaran dan latihan terstruktur dan evaluasi sangat baik, (materi latihan yang jelas dan kemampuan yang dihasilkan setelah latihan bisa terukur) sehingga progres yg baik juga bisa dirasakan dalam kehidupan sehari-hari</p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="img-fluid zoom-fade" src="{{ asset('landing/images/team/admin.png') }}" alt="">
                                </div>
                                <div class="testimonial-caption">
                                    <h5>Maya</h5>
                                    <label>Batch 7</label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial style-4">
                                <div class="testimonial-content">
                                    <div class="testimonial-quote"><i class="la la-quote-left"></i>
                                    </div>
                                    <p>Alhamdulillah,masih bertahan di reeactive karena disamping olahraga memperkuat fisik,tp jg memperkuat batin krn vibes groupnya tuh saling ingetin akhirat</p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="img-fluid zoom-fade" src="{{ asset('landing/images/team/founder.png') }}" alt="">
                                </div>
                                <div class="testimonial-caption">
                                    <h5>Syifa</h5>
                                    <label>Batch 7</label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial style-4">
                                <div class="testimonial-content">
                                    <div class="testimonial-quote"><i class="la la-quote-left"></i>
                                    </div>
                                    <p>Alhamdulillah program ini sangat memudahkan ibu rumah tangga untuk olahraga secara rutin dan terpantau. Programnya juga fleksibel. Coach Dina terutama cukup detail memberikan penjelasan dan arahan. Semoga bisa istoqomah terus aamiin ✨</p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="img-fluid zoom-fade" src="{{ asset('landing/images/team/admin.png') }}" alt="">
                                </div>
                                <div class="testimonial-caption">
                                    <h5>Intan</h5>
                                    <label>Batch 7</label>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial style-4">
                                <div class="testimonial-content">
                                    <div class="testimonial-quote"><i class="la la-quote-left"></i>
                                    </div>
                                    <p>Setelah ikut work out bersama reeacitve & teh rini khususnya yg sabar bgt ngajarin, memperhatikan setiap gerakan, betul salahnya.. jadi ketagihan selalu pengen olah raga.. kalau badan lagi kurang fit, capek, buat work out alhamdulillah jadi seger n bugar lagi... masyaAllah tabarokallahu.. jazakillahu khoir teh Rini 🙏</p>
                                </div>
                                <div class="testimonial-img">
                                    <img class="img-fluid zoom-fade" src="{{ asset('landing/images/team/finance.png') }}" alt="">
                                </div>
                                <div class="testimonial-caption">
                                    <h5>Fidia</h5>
                                    <label>Batch 7</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--#Testimonialsp-->

    <!--Register Now!-->
    <div id="register" class="subscribe-box mt-3 mb-5 wow fadeInUp" data-wow-duration="2s">
        <div class="container">
            <div class="row subscribe-inner align-items-center">
            <div class="col-md-8 col-sm-12">
                <h2>Daftar Sekarang!</h2>
                <p class="lead mb-0">Tunggu apa lagi? ayo segera bergabung bersama kami</p>
            </div>
            <div class="col-md-4 col-sm-12 mt-3 mt-md-0">
                @if (\Carbon\Carbon::now() <= $openDate)
                    <a class="btn btn-dark wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.5s" href="#" data-text="Belum Buka">
                        <span>T</span><span>u</span><span>n</span><span>g</span><span>g</span><span>u</span>
                        <span>Y</span><span>a</span><span>!</span>
                    </a>
                @else
                    <a class="btn btn-theme wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.5s" href="/member-baru" data-text="Daftar">
                        <span>M</span><span>e</span><span>m</span><span>b</span><span>e</span><span>r</span>
                        <span>B</span><span>a</span><span>r</span><span>u</span>
                    </a>
                @endif
            </div>
            </div>
        </div>
    </div>
    <!--#Register Now!-->

    <!--Kontak-->
    <section id="contact" class="contact-info p-0 z-index-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="contact-media"> <i class="las la-envelope"></i>
                        <span>Email</span>
                        info@reeactive.com
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                    <a href="https://instagram.com/reeactive_id" target="_blank">
                        <div class="contact-media">
                            <i class="lab la-instagram"></i>
                            <span>Instagram</span>
                            @reeactive_id
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                    <a href="https://api.whatsapp.com/send?phone=628111777021">
                        <div class="contact-media">
                            <i class="lab la-whatsapp"></i>
                            <span>Whatsapp</span>
                                0811-1777-021
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--#Kontak-->
@endsection
