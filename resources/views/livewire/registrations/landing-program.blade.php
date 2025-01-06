<div>
    <div class="text-center">
        <h2 class="mb-1">Portal Pendaftaran Reeactive</h2>
        <p class="mb-3">Silahkan pilih program dan kelas sesuai kebutuhan anda</p>
    </div>
    <div class="row row-cols-md-auto justify-content-center align-items-center">
        <div class="col-lg-6 col-12 m-0 mb-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Program Kelas Reguler</h4>
                    <p class="card-text">
                        Program intensif dengan jadwal rutin dan berkelanjutan, tersedia berbagai pilihan kelas
                    </p>
                    <a href="{{ route('new_member') }}" class="btn btn-primary waves-effect">Daftar</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 m-0 mb-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kelas Lepasan</h4>
                    <p class="card-text">
                        Kelas non-program (tidak terikat) yang dapat diikuti per sesi ataupun paket per bulan (4 sesi).
                    </p>
                    <a wire:navigate href="{{ route('form_additional_program') }}" class="btn btn-primary waves-effect">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
