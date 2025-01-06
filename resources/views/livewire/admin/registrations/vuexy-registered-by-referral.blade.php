<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Member Claim Referral</x-slot:title>
        <x-slot:activePage>Member Claim Referral</x-slot:activePage>
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

    <!--Counter Total Member-->
    <div class="row mb-1">
        <div class="col-12">
            <x-badges.basic color="primary">
                {{ $this->countTotalReferralMembers }} Member
            </x-badges.basic>
        </div>
    </div>
    <!--#Counter Total Member-->

    <!--List Of Members-->
    <div class="row">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <x-items.loading-dots class="mb-1" wire:loading wire:target='selectedBatch'/>
        <!--#Loading Indicator-->

        @forelse ($this->upReferralMembers as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job color="primary" wire:key='{{ $member->id }}'>
                    <x-slot:avatarIcon>{{ $loop->iteration }}</x-slot:avatarIcon>
                    <x-slot:title>{{ $member->member_name }}</x-slot:title>
                    <x-slot:subTitle>
                        Coach {{ $member->registrations[0]->coach->nick_name }} - {{ $member->registrations[0]->program->program_name }}
                    </x-slot:subTitle>
                    <x-slot:label>
                        <x-items.wa-icon width="25" height="25" href="https://wa.me/{{ $member->mobile_phone }}"/>
                    </x-slot:label>
                    <x-slot:headingContent>
                        Kode Referral : {{ $member->referral->code }}
                    </x-slot:headingContent>
                    {{ $member->referralRegistrations->count() }} New Member Terdaftar
                    @if($member->referralRegistrations->count() > 0)
                        @foreach ($member->referralRegistrations as $registeredMember)
                            <div class="d-flex justify-content-between">
                                <div>
                                    {{ $registeredMember->registration->member->member_name }}
                                </div>
                                <div class="align-self-center">
                                    @if ($registeredMember->is_cashback == 0)
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Sudah Claim" class="text-success">
                                            Diskon
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square font-medium-2 align-self-center"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                        </a>
                                    @else
                                        @if ($registeredMember->is_used == 0)
                                            <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateClaimCashBack" @click="$dispatch('set-data-update-cashback', { id: '{{Crypt::encrypt($registeredMember->id)}}' })">
                                                Claim
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2 align-self-center"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            </a>
                                        @else

                                            <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#modalUpdateClaimCashBack" @click="$dispatch('set-data-update-cashback', { id: '{{Crypt::encrypt($registeredMember->id)}}' })">
                                                Cashback
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square font-medium-2 align-self-center"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <x-slot:highlight>
                        <h2 class="d-inline me-25">
                            {{ \App\Helpers\CurrencyHelper::formatRupiah($member->referralRegistrations->sum('discount')) }}
                        </h2>
                    </x-slot:highlight>
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found />
            </div>
        @endforelse

        @if ($this->upReferralMembers->hasMorePages())
            <div class="col-12 text-center">
                <x-buttons.outline-primary wire:click='loadMore'>Tampilkan Lagi</x-buttons.outline-primary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            </div>
        @endif
    </div>
    <!--#List Of Members-->

    <!--Modal Update Claim Cashback-->
    <livewire:components.modals.admin.modal-update-claim-cashback idModal="modalUpdateClaimCashBack"/>
    <!--#Modal Update Claim Cashback-->

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
        <script data-navigate-once>
            window.addEventListener('success-update-status-claim', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    '👋Proses claim berhasil',
                    'OK!',
                    {
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                    );
                }, 500);
            });
        </script>
    @endpush
</div>
