<div>
    <div class="text-center mb-2">
        <h2>Pendaftaran Berhasil</h2>
    </div>

    <div class="d-flex align-items-center justify-content-center">
        <div class="col-6">
            <x-vuexy.cards.basic-card>
                <p style="text-align: justify">
                    Selamat, <strong>{{ $memberName }}</strong> anda telah resmi menjadi member Reeactive, berikut detail pendaftaran anda :
                    <br/><br/>
                    Program : <strong>{{ $programName }}</strong><br/>
                    Coach : <strong>{{ $coachNickName }} ({{ $coachFullName }})</strong><br/>
                    Kelas : <strong>{{ $classDay }} ({{ $startTime }} - {{ $endTime }})</strong>
                    <br/><br/>
                    untuk mendapatkan informasi selanjutnya, silahkan anda login menggunakan <b class="text-primary">Username & Password</b> yang telah anda buat.
                </p>
                <div class="row text-center">
                    <div class="col-12">
                        <a href="/login">
                            <x-buttons.solid-primary>Login Sekarang</x-buttons.solid-primary>
                        </a>
                    </div>
                </div>
            </x-vuexy.cards.basic-card>
        </div>
    </div>

</div>
