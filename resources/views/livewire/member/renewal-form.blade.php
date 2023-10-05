<div>
    <div class="col-lg-7 col-12">
        <x-cards.basic-card>
            <x-slot name="cardTitle">Form Renewal Member</x-slot>
            <small class="text-muted">Apabila anda ingin tetap mengikuti program Reeactive, silahkan isi form di bawah ini!</small>
            <form wire:submit.prevent='renewalRegistration' class="mt-3">

                <div class="row">
                    <div class="col-lg-6 col-12 mb-2">
                        <x-inputs.label>Nama Lengkap</x-inputs.label>
                        <x-inputs.readonly placeholder="{{ Auth::user()->full_name }}"></x-inputs.readonly>
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
                    <div class="col-lg-4 col-12 mb-2">
                        <x-inputs.label>Program</x-inputs.label>
                        <x-inputs.select wire:model.live="selectedProgram">
                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                            @foreach ($programs as $program)
                                <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.select>
                    </div>

                    <div class="col-lg-4 col-12 mb-2">
                        <x-inputs.label>Coach</x-inputs.label>
                        <x-inputs.select wire:model.live="selectedCoach">
                            <x-inputs.select-option value="" selected><b class="text-muted">--Pilih--</b></x-inputs.select-option>
                            @foreach ($coaches as $coach)
                                <x-inputs.select-option value="{{ $coach->code }}">{{ $coach->coach_name }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.select>
                    </div>

                    <div class="col-lg-4 col-12 mb-2">
                        <x-inputs.label>Kelas</x-inputs.label>
                        <x-inputs.select wire:model="selectedClass">
                            <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                            @foreach ($classes as $class)
                                <x-inputs.select-option value="{{ $class->id }}">
                                    {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                </x-inputs.select-option>
                            @endforeach
                        </x-inputs.select>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-6 col-12 mb-3">
                        <x-inputs.label>Harga</x-inputs.label>
                        <x-inputs.basic type="text" wire:model="price" readonly/>
                    </div>
                    <div class="col-lg-6 col-12 mb-3">
                        <x-inputs.label>Bukti Transfer</x-inputs.label>
                        <div
                        x-data="{ uploading: false, progress: 5 }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false; progress = 5;"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <!--Choose File-->
                            <x-inputs.basic type="file" wire:click='selectFile' wire:model='fileUpload' accept="image/png, image/jpg, image/jpeg"
                            required
                            oninvalid="this.setCustomValidity('Silahkan lampirkan bukti transfer anda')"
                            oninput="this.setCustomValidity('')"/>

                            <!--Progress Bar-->
                            @if ($showProgressBar == true)
                                <div x-show="uploading">
                                    <div class="progress mt-2">
                                        <div
                                            class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar"
                                            x-bind:style="`width: ${progress}%`"
                                        ></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @error('fileUpload') <small class="error">{{ $message }}</small> @enderror
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

                <div class="row">
                    <div class="col-lg-6 col-12">
                        @error('fileUpload')
                            <button class="btn btn-dark" disabled>Tidak Bisa Daftar</button>
                        @else
                            <button class="btn btn-primary" type="submit">Daftar</button>
                        @enderror
                    </div>
                </div>
            </form>
        </x-cards.basic-card>
    </div>
</div>
