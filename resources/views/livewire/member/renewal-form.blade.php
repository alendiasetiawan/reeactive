<div class="col-lg-8 col-md-7 col-12 layout-spacing">
    <x-cards.basic-card>
        <x-slot name="cardTitle">Form Renewal Member</x-slot>
        <h5>Instruksi Transfer</h5>
        <p>
            Pembayaran dapat dilakukan melalui transfer ke rekening berikut :<br>
            Bank : <b>Bank Syariah Indonesia</b> <br>
            Rekening : <b>725-1586-521</b> <br>
            Atas Nama : <b>CV MUSLIMAH BUGAR INDONESIA</b> <br>
            Kode Bank : <b>451</b>
        </p>
        <form wire:submit.prevent='saveData' class="mt-3">
            <div class="row">
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Nama Lengkap</x-inputs.label>
                    <x-inputs.disable-text placeholder="{{ Auth::user()->full_name }}"></x-inputs.disable-text>
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Jenis Registrasi</x-inputs.label>
                    <x-inputs.select wire:model='registrationCategory' required
                        oninvalid="this.setCustomValidity('Pilih jenis registrasi')"
                        oninput="this.setCustomValidity('')">
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        <x-inputs.select-option>Renewal Member</x-inputs.select-option>
                        <x-inputs.select-option>Come Back</x-inputs.select-option>
                    </x-inputs.select>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Program</x-inputs.label>
                    <x-inputs.select wire:model.live="selectedProgram" required
                    oninvalid="this.setCustomValidity('Silahkan pilih 1 program')"
                    oninput="this.setCustomValidity('')">
                        @if (!$selectedProgram)
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        @endif
                        @foreach ($programs as $program)
                            <x-inputs.select-option
                                value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                </div>

                @if ($selectedProgram != null && $selectedProgram != 3 && $selectedProgram != 4)
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Level</x-inputs.label>
                    <x-inputs.select wire:model.live="selectedLevel" required
                    oninvalid="this.setCustomValidity('Isi level anda saat ini')"
                    oninput="this.setCustomValidity('')">
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        <x-inputs.select-option value="2">Beginner 2.0</x-inputs.select-option>
                        <x-inputs.select-option value="3">Intermediate</x-inputs.select-option>
                    </x-inputs.select>
                </div>
                @endif

                {{-- @if ($selectedProgram)
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Jumlah Sesi</x-inputs.label>
                    <x-inputs.select wire:model.live="selectedSession" required
                    oninvalid="this.setCustomValidity('Pilih jumlah sesi yang anda inginkan')"
                    oninput="this.setCustomValidity('')">
                        @if (!$selectedSession)
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        @endif
                        @foreach ($this->classSessions as $session)
                            <x-inputs.select-option
                                value="{{ $session->id }}">{{ $session->amount }} Sesi</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                    <small class="text-dark">Pilih sesi yang anda inginkan</small>
                </div>
                @endif --}}

                @if ($selectedProgram)
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Coach</x-inputs.label>
                    <x-inputs.select wire:model.live="selectedCoach" required
                    oninvalid="this.setCustomValidity('Anda belum memilih coach')"
                    oninput="this.setCustomValidity('')">
                        @if (!$selectedCoach)
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        @endif

                        @foreach ($this->coaches as $coach)
                            <x-inputs.select-option
                                value="{{ $coach->code }}">Coach {{ $coach->nick_name }} ({{ $coach->coach_name }})</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                </div>
                @endif

                @if ($selectedCoach != null)
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Kelas</x-inputs.label>
                    <x-inputs.select wire:model.live="selectedClass" required
                    oninvalid="this.setCustomValidity('Pilih kelas yang mana?')"
                    oninput="this.setCustomValidity('')">
                        <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                        @foreach ($this->classes as $class)
                            <x-inputs.select-option value="{{ $class->id }}">
                                {{ $class->day }}
                                ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                            </x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                </div>
                @endif
            </div>

            @if ($selectedClass)
            <div class="row">
                <div class="col-12">
                    @if ($isDiscountApply)
                    <div class="alert alert-light-success alert-dismissible fade show border-0 mt-1" role="alert">
                        <strong>Selamat!</strong> Anda mendapatkan diskon untuk pendaftaran Early Bird</button>
                    </div>
                    @endif
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <b>Detail Biaya</b>
                    <br>
                    @if ($isDiscountApply)
                        Biaya Program : <b>{{ CurrencyHelper::formatRupiah($price) }}</b>
                        <br>
                        Discount : <b>(-{{ CurrencyHelper::formatRupiah($amountDisc) }})</b>
                        <br>
                        Total : <b class="text-primary">{{ CurrencyHelper::formatRupiah($totalPrice) }}</b>
                    @else
                        Total : <b class="text-primary">{{ CurrencyHelper::formatRupiah($totalPrice) }}</b>
                    @endif
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Bukti Transfer</x-inputs.label>
                    <div x-data="{ uploading: false, progress: 5 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false; progress = 5;"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!--Choose File-->
                        <x-inputs.basic type="file" wire:click='selectFile' wire:model='fileUpload'
                            accept="image/png, image/jpg, image/jpeg" required
                            oninvalid="this.setCustomValidity('Silahkan lampirkan bukti transfer anda')"
                            oninput="this.setCustomValidity('')" />

                        <!--Progress Bar-->
                        @if ($showProgressBar == true)
                            <div x-show="uploading">
                                <div class="progress mt-2">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                        role="progressbar" x-bind:style="`width: ${progress}%`"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('fileUpload')
                        <small class="text-danger">
                            {{ $message }}
                            Anda bisa mengecilkan ukuran file <a href="https://tinyjpg.com/" target="_blank"><b class="text-info">Disini!</b></a>
                        </small>
                    @enderror
                </div>
                @error('fileUpload')
                    <!--Tampilkan Gambar Rusak-->
                @else
                    <div class="col-lg-6 col-12 mb-3">
                        @if ($fileUpload)
                            <img src="{{ $fileUpload->temporaryUrl() }}" width="200px" height="auto">
                        @endif
                    </div>
                @enderror
            </div>
            @endif


            <div class="row">
                <div class="col-12">
                    @if ($alertQuota)
                        <span class="text-danger">Mohon maaf, quota habis. Silahkan pilih kelas yang lain!</span>
                    @endif
                </div>
                <div class="col-lg-6 col-12">
                    @if ($batchOpen == 1)
                        @if ($alertQuota)
                            <button class="btn btn-dark" disabled>Tidak Bisa Daftar</button>
                        @else
                            @if ($checkBatch[0]->registrations->count() == 0)
                                @error('fileUpload')
                                    <button class="btn btn-dark" disabled>Tidak Bisa Daftar</button>
                                @else
                                    <button class="btn btn-primary" type="submit">Daftar</button>
                                @enderror
                            @else
                                <button class="btn btn-dark" disabled>Anda Sudah Terdaftar</button>
                            @endif
                        @endif
                    @else
                        <button class="btn btn-dark" disabled>Pendaftaran Tutup</button>
                    @endif
                </div>
            </div>
        </form>
    </x-cards.basic-card>
</div>
