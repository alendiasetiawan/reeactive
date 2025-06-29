<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
    @endpush

    <x-modals.basic-modal id="{{ $modalId }}" wire:ignore.self>
        <x-slot:modalTitle>
            {{ $modalType == 'Add' ? 'Tambah Kode Referral' : 'Edit Kode Referral' }}
        </x-slot:modalTitle>

        <!--Exception when id is modified-->
        @if (session('error-selected-id'))
            <div class="row">
                <div class="col-12">
                    <x-alerts.main-alert color="danger">
                        {{ session('error-selected-id') }}
                    </x-alerts.main-alert>
                </div>
            </div>
        @endif
        <!--#Exception when id is modified-->

        <!--Exception when failed to load set value-->
        @if (session('error-set-value'))
            <div class="row">
                <div class="col-12">
                    <x-alerts.main-alert color="danger">
                        {{ session('error-set-value') }}
                    </x-alerts.main-alert>
                </div>
            </div>
        @endif
        <!--#Exception when failed to load set value-->

        <form wire:submit='saveReferralCode'>
            <!--Fields-->
            <div class="row">
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>
                        Nama Influencer
                        <span class="text-danger">*</span>
                    </x-inputs.label>
                    @if ($modalType == 'Add')
                        <x-vuexy.inputs.vuexy-select wire:model.live='influencerId'>
                            <x-vuexy.inputs.vuexy-select-option value="" disabled>--Pilih--</x-vuexy.inputs.vuexy-select-option>
                            @foreach ($listInfluencers as $influencer)
                                <x-vuexy.inputs.vuexy-select-option value="{{ $influencer->id }}">{{ $influencer->name }}</x-vuexy.inputs.vuexy-select-option>
                            @endforeach
                        </x-vuexy.inputs.vuexy-select>
                    @else
                        <x-vuexy.inputs.text wire:model='influencerName' disabled/>
                    @endif
                </div>

                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>
                        Kode Referral
                        <span class="text-danger">*</span>
                    </x-inputs.label>
                    <x-vuexy.inputs.text wire:model.live.debounce.450ms='referralCode'/>
                </div>

                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Status</x-inputs.label>
                    <br/>
                    <x-vuexy.inputs.radio>
                        <x-vuexy.inputs.radio-input
                        id="status-active"
                        name="status"
                        value="1"
                        wire:model.live='status'
                        />
                        <x-slot:label for="status-active">Aktif</x-slot:label>
                    </x-vuexy.inputs.radio>
                    <x-vuexy.inputs.radio>
                        <x-vuexy.inputs.radio-input
                        id="status-inactive"
                        name="status"
                        value="0"
                        wire:model.live='status'
                        />
                        <x-slot:label for="status-inactive">Tidak Aktif</x-slot:label>
                    </x-vuexy.inputs.radio>
                </div>

                <div class="col-lg-6 col-12 mb-1" wire:ignore>
                    <x-inputs.label>Tanggal Expired</x-inputs.label>
                    <x-vuexy.inputs.date-min-today
                    placeholder="Pilih Tanggal"
                    wire:model.live='expiredDate'
                    />
                </div>

                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>
                        Limit Penggunaan Per Batch
                        <span class="text-danger">*</span>
                    </x-inputs.label>
                    <x-vuexy.inputs.number
                    placeholder="Berapa x bisa digunakan?"
                    wire:model.live.debounce.350ms='usedLimit'
                    />
                </div>

                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>
                        Nominal Diskon
                        <span class="text-danger">*</span>
                    </x-inputs.label>

                    <x-vuexy.inputs.text
                    type-currency="IDR"
                    placeholder="Rp"
                    wire:model.live.debounce.350ms='discount'
                    />
                </div>
            </div>
            <!--#Fields-->

            <!--Error Exception-->
            @if (session('error-add-referral-code'))
                <div class="row">
                    <div class="col-12">
                        <x-alerts.main-alert color="danger">
                            {{ session('error-add-referral-code') }}
                        </x-alerts.main-alert>
                    </div>
                </div>
            @endif
            <!--#Error Exception-->

            <!--Button Action-->
            <div class="row">
                <div class="col-12">
                    <x-buttons.basic
                    color="primary"
                    type="submit"
                    :disabled="$isSubmitActivated && !$errors->any() ? false : true"
                    >
                    <x-vuexy.items.colored-spinner color="light" wire:loading wire:target='saveReferralCode'/>
                    Simpan
                    </x-buttons.basic>

                    <x-buttons.outline-secondary
                    data-bs-dismiss="modal"
                    type="button"
                    >
                    Batal
                    </x-buttons.outline-secondary>
                </div>
            </div>
            <!--#Button Action-->
        </form>
    </x-modals.basic-modal>

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
        <script>
            document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
                element.addEventListener('keyup', function(e) {
                let cursorPostion = this.selectionStart;
                    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                    let originalLenght = this.value.length;
                    if (isNaN(value)) {
                    this.value = "";
                    } else {
                    this.value = value.toLocaleString('id-ID', {
                        currency: 'IDR',
                        style: 'currency',
                        minimumFractionDigits: 0
                    });
                    cursorPostion = this.value.length - originalLenght + cursorPostion;
                    this.setSelectionRange(cursorPostion, cursorPostion);
                    }
                });
            });
        </script>
    @endpush
</div>
