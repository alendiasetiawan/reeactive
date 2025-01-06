<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Voucher Merchandise</x-slot:title>
        <x-slot:activePage>Voucher Merchandise</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Filter Data-->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mb-1">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.vuexy-basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-1">
            <x-inputs.label>Pilih Batch</x-inputs.label>
            <x-inputs.vuexy-select wire:model.live='selectedBatch'>
                @foreach ($lastBatches as $batch)
                    <x-inputs.vuexy-select-option value="{{ $batch->id }}">{{ $batch->batch_name }}</x-inputs.vuexy-select-option>
                @endforeach
            </x-inputs.vuexy-select>
        </div>
    </div>
    <!--#Filter Data-->

    <!--Counter Used or UnUsed Voucher-->
    <div class="row">
        <div class="col-12">
            <x-badges.basic color="primary" class="mb-1">Total : {{ $this->countVoucher }}</x-badges.basic>
            <x-badges.basic color="danger" class="mb-1">Sudah Digunakan : {{ $this->voucherUsed }}</x-badges.basic>
            <x-badges.basic color="success" class="mb-1">Belum Digunakan : {{ $this->voucherNotUsed }}</x-badges.basic>
        </div>
    </div>
    <!--#Counter Used or UnUsed Voucher-->

    <div class="row">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <x-items.loading-dots class="mb-1" wire:loading wire:target='selectedBatch'/>
        <!--#Loading Indicator-->

        <!--Alert When ID Parameter Modfied-->
        @if (session('error-id'))
            <div class="col-12">
                <x-alerts.main-alert color="danger">{{ session('error-id') }}</x-alerts.main-alert>
            </div>
        @endif
        <!--#Alert When ID Parameter Modfied-->

        <!--List Of Vouchers-->
        @forelse ($this->listVouchers as $voucher)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job wire:key='{{ $voucher->id }}'>
                    <x-slot:avatar>
                        <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="avatar" width="40" height="40">
                    </x-slot:avatar>
                    <x-slot:title>{{ Str::excerpt($voucher->member_name, '', ['radius' => $isMobile ? 20 : 25]) }}</x-slot:title>
                    <x-slot:subTitle>
                        {{ $voucher->registration->program_name }} - Coach {{ $voucher->registration->nick_name }}
                    </x-slot:subTitle>
                    <x-slot:label>
                        <x-items.wa-icon width="25" height="25" href="https://wa.me/{{ $voucher->no_wa }}"/>
                    </x-slot:label>
                    <x-slot:headingContent>
                        <div class="text-center">
                            ID: #{{ $voucher->qr_code }}
                        </div>
                    </x-slot:headingContent>
                    <div class="text-center mb-1">
                        {{ \SimpleSoftwareIO\QrCode\Facades\QrCode::size(120)->generate(url('validasi-voucher-merchandise/'.$voucher->qr_code)) }}
                    </div>
                    Nominal : {{ \App\Helpers\CurrencyHelper::formatRupiah($voucher->discount) }} <br/>
                    Status :
                    @if ($voucher->is_used == 1)
                        <b class="text-danger">Sudah Digunakan</b> <br/>
                    @else
                        <b class="text-success">Belum Digunakan</b> <br/>
                    @endif
                    @if ($voucher->is_used == 1)
                        Tanggal Digunakan : {{ \Carbon\Carbon::parse($voucher->updated_at)->isoFormat('D MMM Y') }}
                    @endif
                    <x-slot:actionButton>
                        <x-buttons.basic :color="$voucher->is_used == 0 ? 'success' : 'danger'" class="w-100" wire:click="useVoucher('{{ Crypt::encrypt($voucher->id) }}')">
                            @if ($voucher->is_used == 0)
                                Gunakan Voucher
                            @else
                                Batalkan Voucher
                            @endif
                        </x-buttons.basic>
                    </x-slot:actionButton>
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12 text-center">
                <x-alerts.not-found />
            </div>
        @endforelse

        <div class="col-12 text-center">
            @if ($this->listVouchers->hasMorePages())
                <x-buttons.outline-primary wire:click='loadMore'>Tampilkan Lagi</x-buttons.outline-primary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            @endif
        </div>
        <!--#List Of Vouchers-->
    </div>
</div>
