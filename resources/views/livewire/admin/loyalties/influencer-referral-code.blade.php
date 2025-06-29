<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Kode Referral Influencer</x-slot:title>
        <x-slot:activePage>Manajemen Kode Referral</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row mb-1">
        <div class="col-12 mb-1 d-flex justify-content-between align-items-center">
            <!--Action to Add Referral Code-->
            <div>
                @if ($isMobile)
                    <x-buttons.basic color="primary" class="btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddEditReferralInfluencer">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                    </x-buttons.basic>
                @else
                    <x-buttons.basic color="primary" class="btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddEditReferralInfluencer" wire:click="$dispatch('event-add-referral-code')">
                        <x-slot:icon>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M9 12h6" /><path d="M12 9v6" /></svg>
                        </x-slot:icon>
                        Kode Referral
                    </x-buttons.basic>
                @endif
            </div>
            <!--#Action to Add Referral Code-->
            <div>
                <x-badges.basic color="primary">
                    Jumlah Kode : {{ $this->totalReferralCode }}
                </x-badges.basic>
            </div>
        </div>

        <!--Filter code by Influencer-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-vuexy.inputs.vuexy-select wire:model.live='selectedInfluencerId'>
                <x-vuexy.inputs.vuexy-select-option value="">Semua Influencer</x-vuexy.inputs.vuexy-select-option>
                @foreach ($listInfluencers as $influencer)
                    <x-vuexy.inputs.vuexy-select-option value="{{ $influencer->id }}">{{ $influencer->name }}</x-vuexy.inputs.vuexy-select-option>
                @endforeach
            </x-vuexy.inputs.vuexy-select>
        </div>
        <!--#Filter code by Influencer-->
    </div>

    <!--Loading indicator when filter influencer is selected-->
    <div class="row">
        <x-vuexy.items.loading-dots wire:loading wire:target='selectedInfluencerId'/>
    </div>
    <!--Loading indicator when filter influencer is selected-->

    <!--List Referral Code-->
    <div class="row @if($isMobile) scroller5 @else scroller6 @endif" wire:loading.remove wire:target='selectedInfluencerId'>
        @forelse ($this->paginateReferralCodes as $referral)
            <div class="col-lg-4 col-md-6 col-12" wire:key="code-{{ $referral->id }}">
                <x-vuexy.cards.role-card>
                    <x-slot:judul>{{ $referral->influencer_name }}</x-slot:judul>

                    <!--Edit/Delete Action-->
                    <x-slot:sub_judul>
                        <div>
                            <a href="#" data-bs-toggle="dropdown" class="text-dark">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical font-medium-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                            </a>
                            <x-vuexy.buttons.dropdown-menu>
                                <x-vuexy.buttons.dropdown-item
                                wire:click="$dispatch('event-edit-referral-code', {'id' : '{{ Crypt::encrypt($referral->id) }}' })"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAddEditReferralInfluencer">Edit</x-vuexy.buttons.dropdown-item>

                                @if ($referral->total_referral_registered >= 1)
                                    <x-vuexy.buttons.dropdown-item href="#" class="text-muted">
                                        Hapus
                                    </x-vuexy.buttons.dropdown-item>
                                @else
                                    <x-vuexy.buttons.dropdown-item
                                    wire:click="dispatch('event-delete-referral-code', {'id' : '{{ Crypt::encrypt($referral->id) }}' })"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteReferralCode">
                                        Hapus
                                    </x-vuexy.buttons.dropdown-item>
                                @endif
                            </x-vuexy.buttons.dropdown-menu>
                        </div>
                    </x-slot:sub_judul>
                    <!--#Edit/Delete Action-->

                    <x-slot:konten>{{ $referral->code }}</x-slot:konten>

                    <x-slot:sub_konten>
                        <a @if($referral->total_referral_registered >= 1) href="" @endif>
                            {{ $referral->total_referral_registered }} Member
                        </a>
                        <br/>
                        Valid :
                        @if (\Carbon\Carbon::now() > $referral->expired_date)
                            <span class="text-danger">Expired</span>
                        @else
                            {{ \App\Helpers\TanggalHelper::konversiTanggal($referral->expired_date) }}
                        @endif
                    </x-slot:sub_konten>

                    <x-items.badges.light-success>
                        {{ \App\Helpers\CurrencyHelper::formatRupiah($referral->discount) }}
                    </x-items.badges.light-success>
                </x-vuexy.cards.role-card>
            </div>
        @empty
            <div class="col-12 text-center">
                <x-alerts.not-found />
            </div>
        @endforelse

        <!--Button Load More-->
        @if ($this->paginateReferralCodes->hasMorePages())
            <div wire:loading wire:target='loadMore'>
                <x-vuexy.items.loading-dots/>
            </div>
            <div class="col-12 text-center" wire:loading.remove wire:target='loadMore'>
                <x-buttons.outline-secondary wire:click='loadMore'>
                    Tampilkan Lagi
                </x-buttons.outline-secondary>
            </div>
        @endif
        <!--#Button Load More-->
    </div>
    <!--#List Referral Code-->

    <!--Modal Add/Edit Referral Code-->
    <livewire:components.modals.admin.royalties.modal-add-referral-influencer modalId="modalAddEditReferralInfluencer" :listInfluencers="$listInfluencers"/>
    <!--#Modal Add/Edit Referral Code-->

    <!--Modal Delete Referral Code-->
    <livewire:components.modals.admin.royalties.modal-delete-referral-code-influencer modalId="modalDeleteReferralCode"/>
    <!--#Modal Delete Referral Code-->

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>

        <!--Toast Success Add Referral Code-->
        <script data-navigate-once>
            window.addEventListener('add-referral-code-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    'Tambah Kode Referral Berhasil',
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
        <!--#Toast Success Add Referral Code-->

        <!--Toast Success Edit Referral Code-->
        <script data-navigate-once>
            window.addEventListener('edit-referral-code-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['info'](
                    'Edit Kode Referral Berhasil',
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
        <!--#Toast Success Edit Referral Code-->

        <!--Toast Success Edit Referral Code-->
        <script data-navigate-once>
            window.addEventListener('delete-referral-code-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['warning'](
                    'Hapus Kode Referral Berhasil',
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
        <!--#Toast Success Edit Referral Code-->
    @endpush
</div>
