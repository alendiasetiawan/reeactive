<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Influencer</x-slot:title>
        <x-slot:activePage>Database Influencer</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row mb-1">
        <!--Action Badge-->
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                @if ($isMobile)
                    <x-buttons.basic color="primary" class="btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddInfluencer">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                    </x-buttons.basic>
                @else
                    <x-buttons.basic color="primary" class="btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddInfluencer">
                        <x-slot:icon>
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M9 12h6" /><path d="M12 9v6" /></svg>
                        </x-slot:icon>
                        Influencer
                    </x-buttons.basic>
                @endif
            </div>
            <div>
                <x-badges.basic color="primary">
                    Jumlah Influencer : {{ $this->totalInfluencer }}
                </x-badges.basic>
            </div>
        </div>
        <!--#Action Badge-->
    </div>

    <!--List Influencer-->
    <div class="row @if($isMobile) scroller5 @else scroller6 @endif">

        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='loadMore'/>
        <!--#Loading Indicator-->

        @forelse ($this->listInfluencers as $influencer)
            <div class="col-lg-4 col-md-6 col-12" wire:key='inf-{{ $influencer->id }}' wire:loading.remove wire:target='loadMore'>
                <x-vuexy.cards.apply-job
                color="primary">
                    <x-slot:title>{{ $influencer->name }}</x-slot:title>
                    <x-slot:subTitle>
                        @if ($influencer->phone)
                            +{{ $influencer->country_code }}{{ $influencer->phone }}
                            <a href="https://wa.me/{{ $influencer->country_code }}{{ $influencer->phone }}" target="_blank">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp text-success font-medium-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                            </a>
                        @else
                            -
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp text-muted font-medium-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                        @endif
                    </x-slot:subTitle>

                    <x-slot:avatar>
                        <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="Avatar" width="40" height="40">
                    </x-slot:avatar>

                    <!--Edit/Delete Influencer-->
                    <x-slot:label>
                        <div>
                            <a href="#" data-bs-toggle="dropdown" class="text-dark">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical font-medium-3"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                            </a>
                            <x-vuexy.buttons.dropdown-menu>
                                <x-vuexy.buttons.dropdown-item
                                wire:click="setIdEditInfluencer('{{ Crypt::encrypt($influencer->id) }}')"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditInfluencer">Edit</x-vuexy.buttons.dropdown-item>

                                @if ($influencer->total_member_registered >= 1)
                                    <x-vuexy.buttons.dropdown-item href="#" class="text-muted">
                                        Hapus
                                    </x-vuexy.buttons.dropdown-item>
                                @else
                                    <x-vuexy.buttons.dropdown-item
                                    wire:click="setIdInfluencer('{{ Crypt::encrypt($influencer->id) }}')"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteInfluencer">
                                        Hapus
                                    </x-vuexy.buttons.dropdown-item>
                                @endif
                            </x-vuexy.buttons.dropdown-menu>
                        </div>
                    </x-slot:label>
                    <!--Edit/Delete Influencer-->

                    <x-slot:headingContent>
                        <!--Social Media-->
                        <div class="d-flex justify-content-between">
                            <a href="{{ $influencer->link_instagram ? $influencer->link_instagram : '#' }}" target="_blank">
                                <div class="d-flex align-items-center">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram {{ $influencer->link_instagram ? 'text-primary' : 'text-muted' }}"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M16.5 7.5v.01" /></svg>
                                    <span class="{{ $influencer->link_instagram ? 'text-primary' : 'text-muted' }}">Instagram</span>
                                </div>
                            </a>
                            <a href="{{ $influencer->link_facebook ? $influencer->link_facebook : '#' }}" target="_blank">
                                <div class="d-flex align-items-center">
                                    <span class="{{ $influencer->link_facebook ? 'text-primary' : 'text-muted' }}">Facebook</span>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook {{ $influencer->link_facebook ? 'text-primary' : 'text-muted' }}"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                                </div>
                            </a>
                        </div>
                        <!--#Social Media-->
                    </x-slot:headingContent>

                    <!--Catatan-->
                    @if (!is_null($influencer->note))
                        <p>{{ $influencer->note }}</p>
                    @endif
                    <!--#Catatan-->

                    <!--List Referral Code-->
                    <div class="">
                        <span>Kode Referral</span>
                        <a href="#" wire:click="setIdInfluencer('{{ Crypt::encrypt($influencer->id) }}')" data-bs-toggle="modal" data-bs-target="#modalAddReferral">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus font-medium-2 text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12h6" /><path d="M12 9v6" /><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /></svg>
                        </a>
                    </div>
                    <div class="@if($influencer->total_referral_code > 3) mini-scroller @endif">
                        @forelse ($influencer->influencerReferrals as $referral)
                            <div class="d-flex justify-content-between @if($referral->is_active != 1 || \Carbon\Carbon::now() > $referral->expired_date) text-muted @endif">
                                <div class="progress-stats" x-data="{ showMsg: false }">
                                    <div x-data="{ input: '{{ $referral->code }}', showMsg: false }" >
                                        <span>{{ $referral->code }}</span>
                                        <a href="javascript:void(0)" @click="navigator.clipboard.writeText(input), showMsg = true, setTimeout(() => showMsg = false, 1000)" class="text-dark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy font-medium-2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                        </a>
                                        <div x-show="showMsg" @click.away="showMsg = false" style="display: none;">
                                            Kode Disalin!
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span>{{ $referral->total_referral_registered }} Member</span>
                                </div>
                                {{-- <span>{{ $referral->code }}</span>
                                <span>{{ $referral->total_referral_registered }} Member</span> --}}
                            </div>
                        @empty
                            <em>Belum memiliki kode referral</em>
                        @endforelse
                    </div>
                    <!--#List Referral Code-->
                </x-vuexy.cards.apply-job>
            </div>
        @empty
            <div class="col-12 text-center">
                <x-alerts.not-found />
            </div>
        @endforelse

        <!--Button Load More-->
        @if ($this->listInfluencers->hasMorePages())
            <div class="col-12 text-center">
                <x-buttons.outline-secondary wire:click='loadMore'>
                    Tampilkan Lagi
                </x-buttons.outline-secondary>
            </div>
        @endif
        <!--#Button Load More-->
    </div>
    <!--#List Influencer-->

    <!---Modal Add Influencer-->
    <livewire:components.modals.admin.royalties.modal-add-influencer modalId="modalAddInfluencer" modalType="addInfluencer"/>
    <!---#Modal Add Influencer-->

    <!--Modal Edit Influencer-->
    <livewire:components.modals.admin.royalties.modal-add-influencer modalId="modalEditInfluencer" modalType="editInfluencer" :selectedIdInfluencer="$selectedIdInfluencer" />
    <!--#Modal Edit Influencer-->

    <!--Modal Add Referral-->
    <livewire:components.modals.admin.royalties.modal-add-referral-per-influencer modalId="modalAddReferral" :selectedIdInfluencer="$selectedIdInfluencer" />
    <!--#Modal Add Referral-->

    <!--Modal Delete Influencer-->
    <livewire:components.modals.admin.royalties.modal-delete-influencer modalId="modalDeleteInfluencer" :selectedIdInfluencer="$selectedIdInfluencer" />

    <!--#Modal Delete Influencer-->

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>

        <script data-navigate-once>
            window.addEventListener('delete-influencer-success', event => {
                $('#modalDeleteInfluencer').modal('hide');
            });
        </script>

        <script data-navigate-once>
            window.addEventListener('add-influencer-success', event => {
                $('#modalAddInfluencer').modal('hide');
            });
        </script>

        <!--Toast Success Delete Influencer-->
        <script data-navigate-once>
            window.addEventListener('delete-influencer-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['warning'](
                    'Hapus data influencer berhasil',
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
        <!--#Toast Success Delete Influencer-->

        <!--Toast Success Add Influencer-->
        <script data-navigate-once>
            window.addEventListener('add-influencer-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    'Tambah data influencer berhasil',
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
        <!--#Toast Success Add Influencer-->

        <!--Toast Success Delete Influencer-->
        <script data-navigate-once>
            window.addEventListener('add-referral-code-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    'Tambah kode referral berhasil',
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
        <!--#Toast Success Delete Influencer-->
    @endpush
</div>
