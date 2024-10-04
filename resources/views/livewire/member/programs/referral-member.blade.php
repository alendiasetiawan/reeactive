<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('member::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Referral Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-lg-6 col-12">
            <x-cards.transaction>
                <x-slot:cardTitle>Pendaftaran via Kode Referral</x-slot:cardTitle>
                <div class="row">
                    <div class="col-lg-6 col-12 mb-4">
                        <!--Filter Batch-->
                        <x-inputs.label>Batch</x-inputs.label>
                        <x-inputs.select wire:model='selectedBatch'>
                            <x-inputs.select-option value="null">--Pilih Batch--</x-inputs.select-option>
                        </x-inputs.select>
                        <!--#Filter Batch-->
                    </div>
                </div>

                <!--List Of Members-->
                @foreach ($this->referralMembers as $member)
                    <x-cards.transaction-list>
                        <x-slot:mainContent>{{ $member->registration->member->member_name }}</x-slot:mainContent>
                        <x-slot:subContent>Batch 12 - Coach Dina</x-slot:subContent>
                        <x-slot:label>12 Jan 2024</x-slot:label>
                    </x-cards.transaction-list>
                @endforeach
                <!--#List Of Members-->
            </x-cards.transaction>
        </div>

        <div class="col-lg-6 col-12">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Diskon</h5>
                            <p class="mb-0">Rp 50.000</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Cashback</h5>
                            <p class="mb-0">Rp 50.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
