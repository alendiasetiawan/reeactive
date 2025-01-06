<div>
    <x-vuexy.modals.basic-modal id="{{ $modalId }}" wire:ignore.self>
        <x-slot:modalTitle>Edit Kelas</x-slot:modalTitle>
        @if (session('invalid-id'))
            <div class="row">
                <div class="col-12">
                    <x-alerts.main-alert color="danger">{{ session('invalid-id') }}</x-alerts.main-alert>
                </div>
            </div>
        @else
        {{ $classId }}
        @endif
    </x-vuexy.modals.basic-modal>
</div>
