<div>
    <form wire:submit='save'>
        <div class="row">
            <div class="col-12 mb-2">
                Coach : {{ $coach }} <br>
                Hari : {{ $day }} <br>
                Waktu : {{ \Carbon\Carbon::parse($start)->format('H:i') }} - {{ \Carbon\Carbon::parse($end)->format('H:i') }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 mb-2">
                <x-inputs.label>Untuk <b class="text-primary">New Member</b></x-inputs.label>
                <x-inputs.vuexy-select wire:model.live='setNewMember'>
                    <x-inputs.vuexy-select-option>{{ $statusNewMember }}</x-inputs.vuexy-select-option>
                    @if ($statusNewMember != 'Open')
                    <x-inputs.vuexy-select-option>Open</x-inputs.vuexy-select-option>
                    @endif
                    @if ($statusNewMember != 'Close')
                    <x-inputs.vuexy-select-option>Close</x-inputs.vuexy-select-option>
                    @endif
                </x-inputs.vuexy-select>
            </div>

            <div class="col-lg-6 col-12 mb-2">
                <x-inputs.label>Untuk <b class="text-secondary">Renewal Member</b></x-inputs.label>
                <x-inputs.vuexy-select wire:model.live='setRenewal'>
                    <x-inputs.vuexy-select-option>{{ $statusRenewal }}</x-inputs.vuexy-select-option>
                    @if ($statusRenewal != 'Open')
                    <x-inputs.vuexy-select-option>Open</x-inputs.vuexy-select-option>
                    @endif
                    @if ($statusRenewal != 'Close')
                    <x-inputs.vuexy-select-option>Close</x-inputs.vuexy-select-option>
                    @endif
                </x-inputs.vuexy-select>
            </div>

            <div class="col-12">
                <x-buttons.basic color="primary" type="submit">Simpan</x-buttons.basic>
                <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Batal</x-buttons.outline-dark>
            </div>
        </div>
    </form>
</div>
