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
                <x-inputs.select wire:model.live='setNewMember'>
                    <x-inputs.select-option>{{ $statusNewMember }}</x-inputs.select-option>
                    @if ($statusNewMember != 'Open')
                    <x-inputs.select-option>Open</x-inputs.select-option>
                    @endif
                    @if ($statusNewMember != 'Close')
                    <x-inputs.select-option>Close</x-inputs.select-option>
                    @endif
                </x-inputs.select>
            </div>

            <div class="col-lg-6 col-12 mb-2">
                <x-inputs.label>Untuk <b class="text-secondary">Renewal Member</b></x-inputs.label>
                <x-inputs.select wire:model.live='setRenewal'>
                    <x-inputs.select-option>{{ $statusRenewal }}</x-inputs.select-option>
                    @if ($statusRenewal != 'Open')
                    <x-inputs.select-option>Open</x-inputs.select-option>
                    @endif
                    @if ($statusRenewal != 'Close')
                    <x-inputs.select-option>Close</x-inputs.select-option>
                    @endif
                </x-inputs.select>
            </div>

            <div class="col-12 mt-2">
                <x-buttons.solid-primary>Simpan</x-buttons.solid-primary>
            </div>
        </div>
    </form>
</div>
