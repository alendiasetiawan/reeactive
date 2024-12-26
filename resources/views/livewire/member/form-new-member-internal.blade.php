<div class="col-lg-8 col-md-7 col-12 layout-spacing">
    <x-cards.basic-card>
        <x-slot name="cardTitle">Daftar Program Reguler</x-slot>

        <!--Alert when registrtaion is failed-->
        @if (session('failed-registration'))
            <div class="row">
                <div class="col-12 mb-2">
                    <x-items.alerts.light-danger>
                        {{ session('failed-registration') }}
                    </x-items.alerts.light-danger>
                </div>
            </div>
        @endif
        <!--#Alert when registrtaion is failed-->

        <form wire:submit='register'>
            <div class="row">
                <small>Silahkan isi form di bawah ini, untuk detail biaya dan rekening akan muncul setelah anda memilih <strong class="text-primary">Program dan Kelas</strong></small>
                <br/>
                <br/>
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Program</x-inputs.label>
                    <x-inputs.select wire:model.live='selectedProgram'>
                        <x-inputs.select-option value='' disabled>--Pilih--</x-inputs.select-option>
                        @foreach ($this->programs as $program)
                            <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Coach</x-inputs.label>
                    <x-inputs.select wire:model.live='selectedCoach'>
                        <x-inputs.select-option value='' disabled>--Pilih--</x-inputs.select-option>
                        @foreach ($this->coaches as $coach)
                            <x-inputs.select-option value="{{ $coach->code }}">Coach {{ $coach->nick_name }} ({{ $coach->coach_name }})</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <x-inputs.label>Kelas</x-inputs.label>
                    <x-inputs.select wire:model.live='selectedClass'>
                        <x-inputs.select-option value='' disabled>--Pilih--</x-inputs.select-option>
                        @foreach ($this->classes as $class)
                            <x-inputs.select-option value='{{ $class->id }}'>{{ $class->day }} ({{ $class->start_time }} - {{ $class->end_time }})</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
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

            @if ($selectedClass)
                <div class="row">
                    <div class="col-lg-6 col-12 mb-3">
                        Detail Biaya
                        <br>
                        @if ($isDiscountApply)
                            Biaya Program : <b>{{ CurrencyHelper::formatRupiah($price) }}</b>
                            <br>
                            Discount : <b>(-{{ CurrencyHelper::formatRupiah($amountDisc) }})</b>
                            <br>
                            Jenis Diskon : <b>{{ $discountType }}</b>
                            <br/>
                            Total : <b class="text-primary">{{ CurrencyHelper::formatRupiah($totalPrice) }}</b>
                        @else
                            Total : <b class="text-primary">{{ CurrencyHelper::formatRupiah($totalPrice) }}</b>
                        @endif
                    </div>
                    <h5>Instruksi Transfer</h5>
                    <p>
                        Pembayaran dapat dilakukan melalui transfer ke rekening berikut :<br>
                        Bank : <b>Bank Syariah Indonesia</b> <br>
                        Rekening : <b>725-1586-521</b> <br>
                        Atas Nama : <b>CV MUSLIMAH BUGAR INDONESIA</b> <br>
                        Kode Bank : <b>451</b>
                    </p>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <x-buttons.solid-primary type="submit" :disabled="$isSubmitActive && !$errors->any() ? false : true">Daftar</x-buttons.solid-primary>
                </div>
            </div>
        </form>
    </x-cards.basic-card>
</div>
