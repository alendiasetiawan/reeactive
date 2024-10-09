<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('member::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Referral Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-lg-6 col-12 mb-3">
            <x-cards.transaction>
                <x-slot:cardTitle>Pendaftaran via Kode Referral</x-slot:cardTitle>
                <div class="row">
                    <div class="col-lg-6 col-12 mb-4">
                        <!--Filter Batch-->
                        <x-inputs.label>Pilih Batch</x-inputs.label>
                        <x-inputs.select wire:model.live='selectedBatch'>
                            @foreach ($lastBatches as $batch)
                                <x-inputs.select-option value="{{ $batch->id }}">{{ $batch->batch_name }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.select>
                        <!--#Filter Batch-->
                    </div>
                </div>

                <!--List Of Members-->
                <div class="row scrollbar-hidden-y">
                    @forelse ($this->referralMembers as $member)
                        <x-cards.transaction-list>
                            <x-slot:mainContent>{{ Str::excerpt($member->registration->member->member_name, '', [
                                'radius' => 20
                            ]) }}</x-slot:mainContent>
                            <x-slot:subContent>{{ $member->registration->program_name }} - Coach {{ $member->registration->nick_name }}</x-slot:subContent>
                            <x-slot:label>{{ \App\Helpers\TanggalHelper::konversiTanggal($member->created_at) }}</x-slot:label>
                        </x-cards.transaction-list>
                    @empty
                    <div class="col-12">
                        <x-items.alerts.light-danger>Belum ada member yang daftar menggunakan kode anda</x-items.alerts.light-danger>
                    </div>
                    @endforelse
                </div>
                <!--#List Of Members-->
            </x-cards.transaction>
        </div>

        <div class="col-lg-6 col-12">
            <div class="row">
                <div class="col-12 mb-3">
                    <!--Total Discount Get By User-->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Diskon</h5>
                            <p class="mb-0">{{ \App\Helpers\CurrencyHelper::formatRupiah($this->totalDiscount) }}</p>
                        </div>
                    </div>
                    <!--#Total Discount Get By User-->
                </div>
                <div class="col-12 mb-3">
                    <!--Total Cashback Get By User-->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Cashback</h5>
                            <p class="mb-0">{{ \App\Helpers\CurrencyHelper::formatRupiah($this->totalCashback) }}</p>
                        </div>
                    </div>
                    <!--#Total Cashback Get By User-->
                </div>
            </div>
        </div>
    </div>
</div>
