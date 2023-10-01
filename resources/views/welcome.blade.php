@extends('landing.frontpage')

@section('content')
<section id="about" class="text-center wow fadeInUp" data-wow-duration="2s" data-bg-img="{{ asset('landing/images/pattern/02.png') }}">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">
            <div class="section-title">
                <h2 class="title">What we do for <span class="text-theme">your fit</span></h2>
            </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-4 col-md-12">
          <div class="featured-item style-2">
            <div class="featured-icon"> <i class="flaticon-data"></i>
              <span class="rotateme"></span>
            </div>
            <div class="featured-title">
              <h5>Educate</h5>
            </div>
            <div class="featured-desc">
              <p>Materi mengenai gerakan dasar, keseimbangan energi dan mitos diet</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
          <div class="featured-item style-2">
            <div class="featured-icon"> <i class="flaticon-collaboration"></i>
              <span class="rotateme"></span>
            </div>
            <div class="featured-title">
              <h5>Coach</h5>
            </div>
            <div class="featured-desc">
              <p>Pelatihan olahraga yang berfokus pada strenght, cardio & flexibility</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
          <div class="featured-item style-2">
            <div class="featured-icon"> <i class="flaticon-market"></i>
              <span class="rotateme"></span>
            </div>
            <div class="featured-title">
              <h5>Maintenance</h5>
            </div>
            <div class="featured-desc">
              <p>Pengawasan pola makan, free consult with coach & support group member</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
