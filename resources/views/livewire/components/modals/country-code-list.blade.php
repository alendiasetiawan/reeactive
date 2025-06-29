<div>
    <x-modals.top-center id="{{ $modalId }}" wire:ignore.self style="z-index: 1060;">
        <x-slot:header>Daftar Kode Negara</x-slot:header>
        <x-slot:content>
            <div class="row">
                <div class="col-12 mb-1">
                    <x-vuexy.inputs.text placeholder="Cari kode/nama negara" wire:model.live.debounce.450ms='search'/>
                </div>
                <div class="col-12">
                    <ul class="list-group scroller2">
                        @foreach ($countryCodeLists as $code)
                            <button
                            type="button"
                            class="list-group-item d-flex align-items-center list-group-item-action"
                            wire:click="setCountryCode({{ $code->code }})"
                            data-bs-dismiss="modal">
                                <span>{{ $code->country_name }}</span>
                                <span class="badge bg-primary rounded-pill ms-auto">+{{ $code->code }}</span>
                            </button>
                        @endforeach
                    </ul>
                </div>
            </div>
        </x-slot:content>
    </x-modals.top-center>
</div>
