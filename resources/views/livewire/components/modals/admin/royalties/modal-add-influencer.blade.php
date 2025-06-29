<div>
    <x-modals.basic-modal id="{{ $modalId }}" wire:ignore.self>
        <x-slot:modalTitle>
            {{ $modalType == 'editInfluencer' ? 'Edit Influencer' : 'Tambah Influencer' }}
        </x-slot:modalTitle>
        <form wire:submit='saveInfluencer'>
            <div class="row">
                <div class="col-lg-6 col-12 mb-1">
                    <x-vuexy.inputs.label>Nama Influencer <span class="text-danger">*</span></x-vuexy.inputs.label>
                    <x-vuexy.inputs.text placeholder="Tulis nama lengkap" wire:model.live.debounce.350ms='influencerName'/>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-vuexy.inputs.label>Nomor Whatsapp</x-vuexy.inputs.label>
                    <x-vuexy.inputs.basic-merge>
                        <x-slot:icon>
                            <a class="text-dark" wire:click="$dispatch('open-country-code-list')" data-bs-toggle="modal" data-bs-target="#modalCountryCode">
                                +{{ $countryCode }}
                            </a>
                        </x-slot:icon>
                        <x-vuexy.inputs.number placeholder="8572836492" wire:model.live.debounce.350ms='phoneNumber' inputmode="numeric"
                        oninput="this.value = this.value.replace(/^0+/, '').replace(/[^0-9]/g, '')"/>
                    </x-vuexy.inputs.basic-merge>
                    @error('phoneNumber')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-12 mb-1">
                    <x-vuexy.inputs.label>Link Instagram</x-vuexy.inputs.label>
                    <x-vuexy.inputs.text placeholder="https://www.instagram.com/" wire:model='instagramLink'/>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-vuexy.inputs.label>Link Facebook</x-vuexy.inputs.label>
                    <x-vuexy.inputs.text placeholder="https://www.facebook.com/" wire:model='facebookLink'/>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-1">
                    <x-vuexy.inputs.label>Catatan</x-vuexy.inputs.label>
                    <x-vuexy.inputs.textarea rows="3" wire:model='note'/>
                </div>
            </div>

            @if (session('error-add-influencer'))
                <div class="row">
                    <div class="col-12">
                        <x-alerts.main-alert color="danger">
                            {{ session('error-add-influencer') }}
                        </x-alerts.main-alert>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <x-buttons.basic color="primary" type="submit" :disabled="$isSubmitActivated && !$errors->any() ? false : true">Simpan</x-buttons.basic>
                    <x-buttons.outline-secondary data-bs-dismiss="modal" type="reset">Batal</x-buttons.outline-secondary>
                </div>
            </div>
        </form>
    </x-modals.basic-modal>

    <!--Country Code Lists Modal-->
    <livewire:components.modals.country-code-list modalId="modalCountryCode"/>
    <!--#Country Code Lists Modal-->
</div>
