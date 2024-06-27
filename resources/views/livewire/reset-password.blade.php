<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        <span class="text-secondary">Home</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
            </ol>
        </nav>
    </div>

    <!--FORM REQUEST RESET-->
    <div class="row layout-top-spacing">
        <div class="d-flex align-items-center justify-content-center mt-3">
            <div class="col-lg-4 col-12">
                <div class="card mx-auto">
                    <div class="card-header">
                        Form Request Reset Password
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <p>
                                    Silahkan tulis <strong class="text-primary">"Nomor Handphone"</strong> yang terdaftar di sistem kami!
                                </p>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="input-group mb-3">
                                    <x-inputs.select wire:model.live.debounce.250ms='countryPhoneCode'>
                                        <x-inputs.select-option value="" disabled selected>Kode Negara...</x-inputs.select-option>
                                        @foreach ($phoneCodes as $code)
                                        <x-inputs.select-option value="{{ $code->code }}">+{{ $code->code }} ({{ $code->country_name }})</x-inputs.select-option>
                                        @endforeach
                                    </x-inputs.select>
                                    <x-inputs.basic type="number" step="any" wire:model.live.debounce.250ms='phone' placeholder="Ex : 85775745484"/>
                                </div>
                            </div>
                            @if ($showResult)
                                @if ($findMember >= 1)
                                <div class="col-12 mb-1">
                                        Selamat! Kami telah menemukan data yang anda cari. Berikut detailnya :
                                        <br/><br/>
                                        Nama : {{ $this->showMember?->member_name }} <br/>
                                        Whatsapp : {{ $this->showMember?->mobile_phone }} <br/>
                                        @if ($this->showMember?->medical_condition != null)
                                            Kondisi Khusus : {{ $this->showMember?->medical_condition }}
                                        @endif
                                        <br/>
                                        Program : {{ $this->showMember?->registrations[0]?->program?->program_name }} <br/>
                                        Coach : {{ $this->showMember?->registrations[0]?->coach?->coach_name }} ({{ $this->showMember->registrations[0]->coach?->nick_name }}) <br/>
                                        Kelas : {{ $this->showMember?->registrations[0]?->class_model?->day }} ({{ $this->showMember->registrations[0]->class_model?->start_time }} - {{ $this->showMember->registrations[0]->class_model?->end_time }})
                                </div>
                                @else
                                <div class="col-12 mb-1">
                                    <p class="text-danger">Data tidak ditemukan, masukan nomor HP yang sudah terdaftar!</p>
                                </div>
                                @endif
                            @endif
                            <div class="col-12 mb-1 text-center mt-1">
                                @if ($isSendingRequest)
                                    @if (session('reset-sent'))
                                        <b class="text-danger">{{ session('reset-sent') }}</b>
                                    @endif
                                @else
                                    @if ($findMember >= 1)
                                    <x-buttons.solid-secondary wire:click='resetPassword'>Reset Password</x-buttons.solid-secondary>
                                    <a href="{{ route('reset_password') }}" wire:navigate>
                                        <x-buttons.outline-danger>Batal</x-buttons.outline-danger>
                                    </a>
                                    @else
                                        @if ($errors->any())
                                            <x-buttons.solid-dark disabled type="button">Cek Data</x-buttons.solid-dark>
                                        @else
                                            <x-buttons.solid-primary wire:click='checkMember' wire:loading.remove>Cek Data</x-buttons.solid-primary>
                                        @endif
                                    @endif
                                @endif
                                <div class="spinner-grow text-primary align-self-center" wire:loading wire:target='checkMember'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--#FORM REQUEST RESET-->

    <script data-navigate-once>
        document.addEventListener('sending-request', function(event) {
            var url = event.detail.url;

            setTimeout( () => {
                window.open(url,"_blank");
            }, 3000);
        });
    </script>
</div>
