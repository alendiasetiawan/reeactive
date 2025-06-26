<div>
    <x-modals.top-center id="{{ $modalId }}" wire:ignore.self>
        <x-slot:header>Perhatian!</x-slot:header>

        <x-slot:title>Hapus Data Influencer</x-slot:title>

        <x-slot:content>
            @if (session('error-delete-influencer'))
                <x-alerts.main-alert color="danger">
                    {{ session('error-delete-influencer') }}
                </x-alerts.main-alert>
            @endif

            @if (session('error-selected-id'))
                <x-alerts.main-alert color="danger">
                    {{ session('error-selected-id') }}
                </x-alerts.main-alert>
            @else
                Anda akan menghapus data a/n <strong>"{{ $queryInfluencerDelete?->name }}"</strong>, apakah yakin?
            @endif
        </x-slot:content>

        <x-slot:modalFooter>
            <x-buttons.basic color="danger" class="btn-sm" wire:click="deleteInfluencer">Hapus</x-buttons.basic>
            <x-buttons.outline-secondary type="reset" class="btn-sm" data-bs-dismiss="modal">Batal</x-buttons.outline-secondary>
        </x-slot:modalFooter>
    </x-modals.top-center>
</div>
