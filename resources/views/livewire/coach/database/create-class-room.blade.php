<div>
    <x-modals.form id="{{ $idModal }}" wire:ignore.self>
        <x-slot:modalHeader>Form Pengajuan Tambah Kelas</x-slot:modalHeader>
        <form wire:submit="sendRequest">
            <div class="row">
                <div class="col-12 mb-3">
                    <x-inputs.label>Program</x-inputs.label>
                    <x-inputs.select wire:model.live.debounce.500ms='selectedProgram'>
                        <x-inputs.select-option value="" selected disabled>--Pilih--</x-inputs.select-option>
                        @foreach ($listPrograms as $program)
                            <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                        @endforeach
                    </x-inputs.select>
                </div>

                <div class="col-12 mb-3">
                    <x-inputs.label>Hari</x-inputs.label>
                    <x-inputs.basic placeholder="Senin, Rabu, Jum'at" wire:model.live.debounce.500ms='day'/>
                </div>

                <div class="col-12 mb-3">
                    <x-inputs.label>Waktu Mulai</x-inputs.label>
                    <x-inputs.basic placeholder="09:00" wire:model.live.debounce.500ms='startTime'/>
                </div>

                <div class="col-12 mb-3">
                    <x-inputs.label>Waktu Selesai</x-inputs.label>
                    <x-inputs.basic placeholder="10:00" wire:model.live.debounce.500ms='endTime'/>
                </div>

                <div class="col-12 mb-3">
                    <x-inputs.label>Link Group Whatsapp</x-inputs.label>
                    <x-inputs.basic wire:model.live.debounce.500ms='linkWa'/>
                </div>
            </div>
            <x-slot:modalFooter>
                <x-buttons.solid-primary type="submit">Kirim</x-buttons.solid-primary>
                <x-buttons.outline-dark data-bs-dismiss="modal">Batal</x-buttons.outline-dark>
            </x-slot:modalFooter>
        </form>
    </x-modals.form>
</div>
