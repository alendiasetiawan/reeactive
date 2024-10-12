<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="/">Dashboard</x-slot>
        <x-slot name="currentPage">Verifikasi Voucher</x-slot>
    </x-items.breadcrumb>

    <!--Filter and Search Data-->
    <div class="row layout-top-spacing">
        <div class="col-lg-4 col-12 mb-3">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.basic placeholder="Tulis nama member..." wire:model.live.debounce.400ms='searchMember'/>
        </div>

        <div class="col-lg-4 col-12 mb-3">
            <x-inputs.label>Pilih Batch</x-inputs.label>
            <x-inputs.select wire:model.live='selectedBatch'>
                @foreach ($lastBatches as $batch)
                    <x-inputs.select-option value="{{ $batch->id }}">{{ $batch->batch_name }}</x-inputs.select-option>
                @endforeach
            </x-inputs.select>
        </div>

        @if($isResetFilter)
        <div class="col-lg-4 col-12 mb-3">
            <x-inputs.label>
                <a href="#" wire:navigate>
                    <strong class="text-danger">
                        Reset Filter
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </strong>
                </a>
            </x-inputs.label>
        </div>
        @endif
    </div>
    <!--#Filter and Search Data-->

    <!--Counter Used or UnUsed Voucher-->
    <div class="row">
        <div class="col-12 mb-3">
            <x-items.badges.solid-primary class="mb-2">Total : {{ $this->countVoucher }}</x-items.badges.solid-primary>
            <x-items.badges.solid-danger class="mb-2">Sudah Digunakan : {{ $this->voucherUsed }}</x-items.badges.solid-danger>
            <x-items.badges.solid-success class="mb-2">Belum Digunakan : {{ $this->voucherNotUsed }}</x-items.badges.solid-success>
        </div>
    </div>
    <!--#Counter Used or UnUsed Voucher-->

    <div class="row match-height">
        <!--Alert When ID Parameter Modfied-->
        @if (session('error-id'))
            <div class="col-12 mb-3">
                    <x-items.alerts.light-danger>{{ session('error-id') }}</x-items.alerts.light-danger>
            </div>
        @endif
        <!--#Alert When ID Parameter Modfied-->

        <!--Show List Of Vouchers-->
        @forelse ($this->listVouchers as $voucher)
            <div class="col-lg-4 col-12 mb-3" wire:key='{{ $voucher->id }}'>
                <x-cards.user>
                    <x-slot name="userImage">
                        <x-cards.user-image src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"></x-cards.user-image>
                    </x-slot>
                    <x-slot name="userName">{{ $voucher->member_name }}</x-slot>
                    <x-slot name="userTitle">
                        <small>{{ $voucher->registration->program_name }} - Coach {{ $voucher->registration->nick_name }}</small>
                    </x-slot>
                    <x-slot name="icon" href="https://wa.me/{{ $voucher->no_wa }}" target="_blank">
                        <i class="fa-brands fa-whatsapp fa-xl" style="color: #19c502;"></i>
                    </x-slot>
                    <div class="text-center mb-3">
                        {{ \SimpleSoftwareIO\QrCode\Facades\QrCode::size(120)->generate(url('validasi-voucher-merchandise/'.$voucher->qr_code)) }}
                    </div>

                    <ul class="mb-0">
                        <li>Nominal : {{ \App\Helpers\CurrencyHelper::formatRupiah($voucher->discount) }}</li>
                        <li>
                            Status :
                            @if ($voucher->is_used == 1)
                                <b class="text-danger">Sudah Digunakan</b>
                            @else
                                <b class="text-success">Belum Digunakan</b>
                            @endif
                        </li>
                        @if ($voucher->is_used == 1)
                            <li>
                                Tanggal Digunakan : {{ \Carbon\Carbon::parse($voucher->updated_at)->isoFormat('D MMM Y') }}
                            </li>
                        @endif
                    </ul>
                    <br/>
                    <div class="text-center">
                        @if ($voucher->is_used == 0)
                            <x-buttons.solid-success class="w-100" wire:click="useVoucher('{{ Crypt::encrypt($voucher->id) }}')">Gunakan Voucher</x-buttons.solid-success>
                        @else
                            <x-buttons.outline-danger class="w-100" wire:click="useVoucher('{{ Crypt::encrypt($voucher->id) }}')">Batalkan Voucher</x-buttons.outline-danger>
                        @endif
                    </div>
                </x-cards.user>
            </div>
        @empty
            <div class="col-12 mb-3">
                <x-items.alerts.light-danger>
                    Mohon maaf, belum ada data yang bisa ditampilkan
                </x-items.alerts.light-danger>
            </div>
        @endforelse
        <!--#Show List Of Vouchers-->

        <!--Action Load More Data-->
        @if ($this->listVouchers->hasMorePages())
            <div class="col-12 text-center mt-2">
                <x-buttons.outline-secondary wire:click='loadMore'>Tampilkan Lagi</x-buttons.outline-secondary>
            </div>
        @endif
        <!--#Action Load More Data-->
    </div>
</div>
