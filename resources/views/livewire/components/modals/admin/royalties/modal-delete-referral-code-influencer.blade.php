<div>
    <x-modals.top-center id="{{ $modalId }}" wire:ignore.self>
        <x-slot:header>Perhatian!</x-slot:header>

        <x-slot:title>Hapus Kode Referral Influencer</x-slot:title>

        <x-slot:content>
            <!--Exception when failed load data-->
            @if (session('error-set-value'))
                <x-alerts.main-alert color="danger">
                    {{ session('error-set-value') }}
                </x-alerts.main-alert>
            @endif
            <!--#Exception when failed load data-->

            <!--Exception when failed to delete data-->
            @if (session('delete-referral-failed'))
                <x-alerts.main-alert color="danger">
                    {{ session('delete-referral-failed') }}
                </x-alerts.main-alert>
            @endif
            <!--#Exception when failed to delete data-->

            @if (session('error-decrypt-id'))
                <x-alerts.main-alert color="danger">
                    {{ session('error-decrypt-id') }}
                </x-alerts.main-alert>
            @else
                Anda akan menghapus kode referral <strong class="text-primary">{{ $querySelectedReferral?->code }}</strong> milik <strong class="text-primary">"{{ $querySelectedReferral?->influencer_name }}"</strong>, apakah yakin?
            @endif
        </x-slot:content>

        <x-slot:modalFooter>
            <form wire:submit='deleteReferralCode'>
                <x-buttons.basic color="danger" class="btn-sm" type="submit">
                    <x-vuexy.items.colored-spinner color="light" wire:loading wire:target='deleteReferralCode'/>
                    Hapus
                </x-buttons.basic>
                <x-buttons.outline-secondary type="reset" class="btn-sm" data-bs-dismiss="modal">Batal</x-buttons.outline-secondary>
            </form>
        </x-slot:modalFooter>
    </x-modals.top-center>
</div>
