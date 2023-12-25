<div>
    <div class="row layout-top-spacing">
    <div class="d-flex align-items-center justify-content-center">
        <h2>Pendaftaran Berhasil</h2>
    </div>
    <div class="d-flex align-items-center justify-content-center mt-3 layout-top-spacing">
        <div class="col-lg-7">
            <div class="card mx-auto mb-3">
                <div class="card-body">
                    <div class="row text-left">
                        <div class="col-lg-12">
                            <p>
                                Selamat <b class="text-primary">{{ $memberName }}</b>, anda telah resmi menjadi member <b>Reeactive.</b> Berikut data pendaftaran anda :<br><br>

                                Program : <b>{{ $programName }}</b><br>
                                Coach : <b>{{ $coachNickName }} ({{ $coachFullName }})</b> <br>
                                Kelas : <b>{{ $classDay }} ({{ \Carbon\Carbon::parse($classStartTime)->format('H:i') }} - {{ \Carbon\Carbon::parse($classEndTime)->format('H:i') }})</b><br><br>

                                silahkan anda <b class="text-primary">Login Ke Aplikasi</b> menggunakan <b>Username : {{ $email }}</b> untuk mendapatkan informasi selanjutnya.
                            </p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-12">
                            <a href="/login">
                            <x-buttons.solid-primary>Login Sekarang</x-buttons.solid-primary>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
