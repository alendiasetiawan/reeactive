<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="/">Dashboard</x-slot>
        <x-slot name="currentPage">Member Claim Referral</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-lg-4 col-12">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
        </div>

        <!--Select Batch-->
        <div class="col-lg-4 col-12">
            <x-inputs.label>Pilih Batch</x-inputs.label>
            <x-inputs.select wire:model.live='selectedBatch'>
                @foreach ($lastBatches as $batch)
                    <x-inputs.select-option value="{{ $batch->id }}">{{ $batch->batch_name }}</x-inputs.select-option>
                @endforeach
            </x-inputs.select>
        </div>
        <!--#Select Batch-->
    </div>

    <div class="row mt-3">
        <!--Counter Total Member-->
        <div class="col-lg-4 col-12">
            <x-items.badges.solid-primary>{{ $this->countTotalReferralMembers }} Member</x-items.badges.solid-primary>
        </div>
        <!--#Counter Total Member-->
    </div>

    <div class="row mt-3">
        @if (session('save-status-claim'))
            <div class="col-12 mb-2">
                <x-items.alerts.light-success>
                    {{ session('save-status-claim') }}
                </x-items.alerts.light-success>
            </div>
        @endif

        <!--List Of Members-->
            @forelse ($this->upReferralMembers as $member)
                <div class="col-lg-4 col-12 mb-3" wire:key='{{ $member->id }}'>
                    <div class="widget widget-five">
                        <div class="widget-heading">
                            <a href="javascript:void(0)" class="task-info">
                                <div class="usr-avatar">
                                    <h5 class="text-white">{{ $loop->iteration }}</h5>
                                </div>
                                <div class="w-title">
                                    <h5>{{ $member->member_name }}</h5>
                                    <small class="text-muted">
                                        Coach {{ $member->registrations[0]->coach->nick_name }} - {{ $member->registrations[0]->program->program_name }}
                                    </small>
                                </div>
                            </a>
                        </div>

                        <div class="widget-content">
                            <p class="mt-1">
                                Kode Referral : {{ $member->referral->code }}
                                <br/>
                                HP : +{{ $member->mobile_phone }}
                                <a href="https://wa.me/{{ $member->mobile_phone }}" class="text-success" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                </a>
                                <br/>
                                Total Claim : {{ \App\Helpers\CurrencyHelper::formatRupiah($member->referralRegistrations->sum('discount')) }}
                            </p>
                            <div class="progress-data">
                                <div class="progress-info">
                                    <div class="task-count">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        <p>{{ $member->referralRegistrations->count() }} New Member Terdaftar</p>
                                    </div>
                                </div>
                                <div class="scroller2">
                                    @if($member->referralRegistrations->count() > 0)
                                        @foreach ($member->referralRegistrations as $registeredMember)
                                            <div class="d-flex justify-content-between mb-1">
                                                <div>
                                                    {{ $registeredMember->registration->member->member_name }}
                                                </div>
                                                <div class="align-self-center">
                                                    @if ($registeredMember->is_cashback == 0)
                                                        Diskon
                                                        <a href="#" class="text-success rounded bs-tooltip" title="Sudah Claim">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                                        </a>
                                                    @else
                                                        Cashback
                                                        @if ($registeredMember->is_used == 0)
                                                            <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateClaimCashBack" @click="$dispatch('set-data-update-cashback', { id: '{{Crypt::encrypt($registeredMember->id)}}' })">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                            </a>
                                                        @else
                                                            <a href="#" class="text-success rounded bs-tooltip" data-bs-toggle="modal" data-bs-target="#modalUpdateClaimCashBack" @click="$dispatch('set-data-update-cashback', { id: '{{Crypt::encrypt($registeredMember->id)}}' })">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div class="col-12">
                <x-items.alerts.light-danger>
                    Mohon maaf, tidak ada data yang bisa ditampilkan
                </x-items.alerts.light-danger>
            </div>
            @endforelse
        <!--#List Of Members-->

        @if ($this->upReferralMembers->hasMorePages())
            <div class="col-12 mt-2 text-center">
                <x-buttons.outline-secondary wire:click='loadMore'>Tampilkan Lagi</x-buttons.outline-secondary>
            </div>
        @endif
    </div>

    <!--Modal Update Claim Cashback-->
    <livewire:components.modals.admin.modal-update-claim-cashback idModal="modalUpdateClaimCashBack"/>
    <!--#Modal Update Claim Cashback-->

    <!--Add Custom Scripts-->
    @push('customScripts')
        <script data-navigate-once>
            window.addEventListener('success-update-status-claim', event => {
                $('#modalUpdateClaimCashBack').modal('hide');
            });
        </script>
    @endpush
    <!--#Add Custom Scripts-->
</div>



