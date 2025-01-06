<div>
    <x-modals.basic-modal id="{{ $idModal }}" wire:ignore.self>
        <x-slot:modalTitle>Update Status Claim Cashback</x-slot:modalTitle>
        <form wire:submit='saveStatusClaim'>
            <div class="row">
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Nama Member</h6>
                    <span>{{ $this->dataReferral->registration->member_name ?? '' }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Tanggal Daftar</h6>
                    <span>{{ \App\Helpers\TanggalHelper::konversiTanggal($this->dataReferral->created_at ?? '') }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Coach</h6>
                    <span>{{ $this->dataReferral->registration->nick_name ?? '' }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Program</h6>
                    <span>{{ $this->dataReferral->registration->program_name ?? '' }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <h6>Nominal</h6>
                    <span>{{ \App\Helpers\CurrencyHelper::formatRupiah($this->dataReferral->discount ?? 0) }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-1">
                    <x-inputs.label>Status Claim</x-inputs.label>
                    <x-inputs.vuexy-select wire:model.live='statusClaim'>
                        <x-inputs.vuexy-select-option value=1>Sudah</x-inputs.vuexy-select-option>
                        <x-inputs.vuexy-select-option value=0>Belum</x-inputs.vuexy-select-option>
                    </x-inputs.vuexy-select>
                </div>
                <div class="col-12 mb-1">
                    <b class="text-danger">PERHATIAN!</b>
                    <br/>
                    <span>
                        Nominal claim cashback sebesar <b>{{ \App\Helpers\CurrencyHelper::formatRupiah($this->dataReferral->discount ?? 0) }}</b> akan diberikan kepada member a/n <b>{{ $this->dataReferral?->member_name }}</b>
                    </span>
                </div>

                <div class="col-12">
                    <x-buttons.solid-primary type="submit">Simpan</x-buttons.solid-primary>
                    <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Tutup</x-buttons.outline-dark>
                </div>
            </div>
        </form>
    </x-modals.basic-modal>
</div>
