<div>
    <div class="row layout-top-spacing">
        <div class="text-center">
            <h2>Akses <b class="text-primary">Private Video Early Postpartum Workshop</b></h2>
        </div>
        <div class="text-center">
            <h5 class="text-secondary">Reeactive x Yofitmos</h5>
        </div>
        <hr>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <div class="col-lg-5">
                <div class="card mx-auto mb-3">

                    <div class="card-body">
                        <span class="text-primary">Untuk bisa melihat video, anda harus memasukan <b>Kode Akses Video</b> pada kolom di bawah ini!</span>
                        <br><br>
                        <x-inputs.label>Kode Akses Video</x-inputs.label>
                        <x-inputs.basic type="text" placeholder="Tulis kode disini..." wire:model.live='inputCode'/>
                        @if ($inputCode != '')
                            @if (!$isCodeValid)
                                <small class="text-form text-danger">Kode tidak valid! Perhatikan huruf besar/kecil dan angka</small>
                            @else
                                <small class="text-form text-success"><b>Selamat! Anda bisa menonton video</b></small>
                            @endif
                        @endif


                        @if ($isCodeValid)
                        <div class="embed-responsive embed-responsive-16by9 mt-3">
                            <iframe class="embed-responsive-item d-none d-md-block d-lg-block d-xl-block" src="{{url('https://www.youtube.com/embed/ZExmQaafNRQ')}}" frameborder="2" allowfullscreen width="100%" height="400"></iframe>
                            <iframe class="embed-responsive-item d-lg-none d-xl-none" src="{{url('https://www.youtube.com/embed/ZExmQaafNRQ')}}" frameborder="2" allowfullscreen width="100%" height="auto"></iframe>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
