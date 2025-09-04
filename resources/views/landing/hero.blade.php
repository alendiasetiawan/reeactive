<section id="home" class="fullscreen-banner banner p-0 overflow-hidden" data-bg-color="#fbfbfb">
    <div class="bg-animation">
      <img class="zoom-fade" src="{{ asset('landing/images/pattern/01.png') }}" alt="">
    </div>
    <div class="align-center pt-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12">
            <img class="img-fluid wow tada" data-wow-duration="2s" src="{{ asset('landing/images/banner/hero-image.webp') }}" alt="">
          </div>
          <div class="col-lg-6 col-md-12 my-5 my-lg-0">
            <h5 class="wow fadeInDown" data-wow-duration="1.5s">Fit For Deen</h5>
            <h2 class="mb-4 wow jackInTheBox" data-wow-duration="2s">
                Online <span class="text-theme">coaching</span> untuk muslimah di penjuru dunia
            </h2>
            <h3 class="mb-4 wow jackInTheBox" data-wow-duration="2s">
                Online <span class="text-theme">coaching</span> for muslim women around the world
            </h3>
            <p class="lead mb-0 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.3s">
                Penyedia jasa pelatih kebugaran secara <em>online</em> dan <em>offline</em> khusus <b class="text-theme">muslimah</b> yang
                mengedepankan syariat islam
            </p>
            <br>
            @if (\Carbon\Carbon::now() >= $openDate)
            <a class="btn btn-dark wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.5s" href="/program" data-text="Daftar">
                <span>N</span><span>e</span><span>w</span>
                <span>M</span><span>e</span><span>m</span><span>b</span><span>e</span><span>r</span>
            </a>
            @endif
            <a class="btn btn-theme wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.5s" href="/login" data-text="Login">
                <span>M</span><span>e</span><span>m</span><span>b</span><span>e</span><span>r</span>
            </a>
          </div>
        </div>
        <div class="row text-center mt-5">
            <div class="col-12 mx-auto">
                <script>
                    CountDownTimer('openBatch', 'countdown');
                    function CountDownTimer(dt, id)
                    {
                        var end = new Date('{{ $openDate }}');
                        var _second = 1000;
                        var _minute = _second * 60;
                        var _hour = _minute * 60;
                        var _day = _hour * 24;
                        var timer;
                        function showRemaining() {
                            var now = new Date();
                            var distance = end - now;
                            if (distance < 0) {

                                // clearInterval(timer);
                                document.getElementById(id).innerHTML = '<a class="btn btn-theme" href="/member-baru">Daftar Sekarang</a> ';
                                return;
                            }
                            var days = Math.floor(distance / _day);
                            var hours = Math.floor((distance % _day) / _hour);
                            var minutes = Math.floor((distance % _hour) / _minute);
                            var seconds = Math.floor((distance % _minute) / _second);

                            if (days <= 0) {
                                document.getElementById(id).innerHTML = hours + ' Jam ';
                                document.getElementById(id).innerHTML += minutes + ' Menit ';
                                document.getElementById(id).innerHTML += seconds + ' Detik';
                            } if (days<=0 && hours <= 0) {
                                document.getElementById(id).innerHTML = minutes + ' Menit ';
                                document.getElementById(id).innerHTML += seconds + ' Detik';
                            }
                            if (days <= 0 && hours <= 0 && minutes <= 0) {
                                document.getElementById(id).innerHTML = seconds + ' Detik';
                            } if (days > 0) {
                                document.getElementById(id).innerHTML = days + ' Hari ';
                                document.getElementById(id).innerHTML += hours + ' Jam ';
                                document.getElementById(id).innerHTML += minutes + ' Menit ';
                                document.getElementById(id).innerHTML += seconds + ' Detik';
                            }


                        }
                        timer = setInterval(showRemaining, 1000);
                    }
                </script>
                @if (\Carbon\Carbon::now() <= $openDate)
                    <h4>Pendaftaran New Member <b class="text-theme">{{ $batch->batch_name }}</b> Insya Allah Akan Dibuka Dalam Waktu:</h4>
                    <br>
                    <h3 id="countdown" class="text-theme"></h3>
                @endif
            </div>
        </div>
      </div>
    </div>
</section>
