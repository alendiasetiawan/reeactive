<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Detail Transfer</x-slot:title>
        <x-slot:firstPage wire:navigate href="{{ route('admin::lepasan_payment_verification') }}">Verifikasi Transfer</x-slot:firstPage>
        <x-slot:activePage>Detail Transfer</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <!--Detail Member-->
        <div class="col-lg-7 col-md-6 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Data Member Kelas Lepasan</x-slot:cardTitle>
                <div class="row" wire:ignore>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Nama Member</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $this->paymentDetail->member_name }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Program</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $this->paymentDetail->program_name }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Coach</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $this->paymentDetail->coach_name }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Kelas</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ \App\Helpers\TanggalHelper::convertImplodeDay($this->paymentDetail->day) }} ({{ \Carbon\Carbon::parse($this->paymentDetail->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($this->paymentDetail->end_time)->format('H:i') }})" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Jumlah Sesi</x-inputs.label>
                        <x-inputs.vuexy-basic value="{{ $this->paymentDetail->classDates->count() }}" disabled/>
                    </div>
                    <div class="col-lg-6 col-12 mb-1">
                        <x-inputs.label>Detail Sesi</x-inputs.label>
                        <ol>
                            @foreach ($this->paymentDetail->classDates as $classDate)
                                <li>{{ \Carbon\Carbon::parse($classDate->date)->isoFormat('dddd, D MMMM Y') }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
        <!--#Detail Member-->

        <!--Detail Payment-->
        <div class="col-lg-5 col-md-6 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Data Transfer</x-slot:cardTitle>
                <div class="row mb-1">
                    <div class="col-4">
                        @if ($paymentStatus == 'Done')
                            <x-badges.basic color="success">Status : Valid</x-badges.basic>
                        @elseif ($paymentStatus == 'Process')
                            <x-badges.basic color="warning">Status : Proses</x-badges.basic>
                        @else
                            <x-badges.basic color="danger">Status : Invalid</x-badges.basic>
                        @endif
                    </div>
                </div>
                <form wire:submit.prevent="saveData">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-1">
                            <x-inputs.label>Nominal Transfer</x-inputs.label>
                            <x-inputs.vuexy-basic value="{{ 'Rp '.number_format($this->paymentDetail->amount_pay,0,',','.') }}" disabled/>
                        </div>
                        <div class="col-lg-6 col-12 mb-1">
                            <x-inputs.label>Waktu Upload</x-inputs.label>
                            <x-inputs.vuexy-basic value="{{ $this->paymentDetail->created_at->isoFormat('lll') }}" disabled/>
                        </div>
                        <div class="col-12 mb-1">
                            <x-inputs.label>Bukti Transfer</x-inputs.label>
                            <img src="{{ asset('storage/'.$this->paymentDetail->file_upload) }}" width="100%" height="auto">
                        </div>
                        <div class="col-12 mb-1">
                            <x-inputs.label>Status Transfer</x-inputs.label>
                            <x-inputs.vuexy-select wire:model.live='paymentStatus'>
                                <x-inputs.vuexy-select-option value="Process">Proses</x-inputs.vuexy-select-option>
                                <x-inputs.vuexy-select-option value="Done">Valid</x-inputs.vuexy-select-option>
                                <x-inputs.vuexy-select-option value="Invalid">Invalid</x-inputs.vuexy-select-option>
                            </x-inputs.vuexy-select>
                        </div>
                        @if ($showReasonInvalid)
                            <div class="col-12 mb-1">
                                <x-inputs.label>Alasan Invalid</x-inputs.label>
                                <textarea wire:model.live.debounce.250ms='invalidReason' class="form-control" rows="3"></textarea>
                            </div>
                        @endif
                        <div class="col-12">
                            <x-buttons.basic color="primary" type="submit" :disabled="!$errors->any() ? false : true">Simpan</x-buttons.basic>
                            <a href="{{ route('admin::lepasan_payment_verification') }}" wire:navigate>
                                <x-buttons.outline-dark type="button">Kembali</x-buttons.outline-dark>
                            </a>
                        </div>
                    </div>
                </form>
            </x-cards.basic-card>
        </div>
        <!--#Detail Payment-->
    </div>
</div>
