<div>
    <x-modals.fadeInUp id="{{ $modalId }}" wire:ignore.self>
        <x-slot name="modalTitle">Status Pembayaran</x-slot>
        <form wire:submit='uploadPayment'>
            <!--Alert when upload error-->
            @if (session('error-upload'))
                <div class="row">
                    <div class="col-12 mb-2">
                        <x-items.alerts.light-danger>
                            {{ session('error-upload') }}
                        </x-items.alerts.light-danger>
                    </div>
                </div>
            @endif
            <!--#Alert when upload error-->

            <!--Form Upload Payment-->
            <div class="row">
                <div class="col-12 mb-2">
                    <x-inputs.label>Status</x-inputs.label>
                    <x-inputs.basic value="{{ $detailRegistration?->payment_status }}"/>
                </div>
                <div class="col-12 mb-2">
                    <x-inputs.label>Alasan</x-inputs.label>
                    <x-inputs.textarea wire:model='invalidReason'/>
                </div>
                <div class="col-12 mb-3">
                    <x-inputs.label>Lampiran Terakhir</x-inputs.label>
                    <br/>
                    <img src="{{ asset('storage/'.$detailRegistration?->file_upload) }}" width="100%" height="auto" alt="Lampiran transfer">
                </div>
                <div class="col-12 mb-1">
                    <span>Silahkan upload ulang bukti transfer anda di bawah ini:</span>
                </div>
                <div class="col-12 mb-1">
                    <x-inputs.label>Bukti Transfer Baru</x-inputs.label>
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
                        </small>
                    @enderror
                    @error('fileUpload')
                        <!--Tampilkan Gambar Rusak-->
                    @else
                        <div class="col-lg-6 col-12 mt-2">
                            @if ($fileUpload)
                                <img src="{{ $fileUpload->temporaryUrl() }}" width="200px" height="auto">
                            @endif
                        </div>
                    @enderror
                </div>
                <div class="col-12 mt-2">
                    <x-buttons.basic type="submit" color="primary" :disabled="$isSubmitActive && !$errors->any() ? false : true">Kirim</x-buttons.basic>
                </div>
            </div>
            <!--#Form Upload Payment-->
        </form>
    </x-modals.fadeInUp>
</div>
