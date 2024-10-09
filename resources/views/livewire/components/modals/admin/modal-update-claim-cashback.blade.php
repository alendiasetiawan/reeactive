<div>
    @use('App\Helpers\TanggalHelper')
    @use('App\Helpers\CurrencyHelper')

    <x-modals.form id="{{ $idModal }}" wire:ignore.self>
        <x-slot:modalHeader>Update Status Claim Cashback</x-slot:modalHeader>
        <form wire:submit='saveStatusClaim'>
            <div class="row">
                <div class="col-lg-6 col-12 mb-3">
                    <h6>Nama Member</h6>
                    <span>{{ $this->dataReferral->registration->member_name ?? '' }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <h6>Tanggal Daftar</h6>
                    <span>{{ TanggalHelper::konversiTanggal($this->dataReferral->created_at ?? '') }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <h6>Coach</h6>
                    <span>{{ $this->dataReferral->registration->nick_name ?? '' }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <h6>Program</h6>
                    <span>{{ $this->dataReferral->registration->program_name ?? '' }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <h6>Nominal</h6>
                    <span>{{ CurrencyHelper::formatRupiah($this->dataReferral->discount ?? 0) }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Status Claim</x-inputs.label>
                    <x-inputs.select wire:model.live='statusClaim'>
                        <x-inputs.select-option value=1>Sudah</x-inputs.select-option>
                        <x-inputs.select-option value=0>Belum</x-inputs.select-option>
                    </x-inputs.select>
                </div>

                <div class="col-12">
                    <x-buttons.solid-primary type="submit">Simpan</x-buttons.solid-primary>
                    <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Tutup</x-buttons.outline-dark>
                </div>
            </div>
        </form>
    </x-modals.form>
</div>
