<div>
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
                    Jumlah Influencer : 1
                </x-badges.basic>
            </div>
        </div>
        <!--#Action Badge-->
    </div>

    <div class="row @if($isMobile) scroller5 @else scroller6 @endif">
        <div class="col-lg-4 col-md-6 col-12">
            <x-vuexy.cards.apply-job
            color="primary"
            title="Andini Siska"
            subTitle="+6285775745484">
                <x-slot:avatar>
                    <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="Avatar" width="40" height="40">
                </x-slot:avatar>

                <!--Edit/Delete Influencer-->
                <x-slot:label>
                    <div>
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit font-medium-4"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>

                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash font-medium-4 text-danger"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    </div>
                </x-slot:label>
                <!--Edit/Delete Influencer-->

                <x-slot:headingContent>
                    <!--Social Media-->
                    <div class="d-flex justify-content-between">
                        <a href="https://instagram.com">
                            <div class="d-flex align-items-center">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M16.5 7.5v.01" /></svg>
                                <span>Instagram</span>
                            </div>
                        </a>
                        <a href="https://instagram.com">
                            <div class="d-flex align-items-center">
                                <span>Facebook</span>
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                            </div>
                        </a>
                    </div>
                    <!--#Social Media-->
                </x-slot:headingContent>

                <!--List Referral Code-->
                <p>Tulis catatan anda disini</p>
                <div>
                    <span>Kode Referral</span>
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus font-medium-2 text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12h6" /><path d="M12 9v6" /><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /></svg>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between">
                        <span>1. ACTIVEDAY</span>
                        20 Member
                    </div>
                </div>
                <!--#List Referral Code-->
            </x-vuexy.cards.apply-job>
        </div>

        <!--Button Load More-->
        {{-- <div class="col-12 text-center">
            <x-buttons.outline-secondary>Tampilkan Lagi</x-buttons.outline-secondary>
        </div> --}}
        <!--#Button Load More-->
    </div>


    <!---Modal Add Influencer-->
    <livewire:components.modals.admin.royalties.modal-add-influencer modalId="modalAddInfluencer"/>
    <!---#Modal Add Influencer-->

    @push('pageScripts')
        <script data-navigate-once>
            window.addEventListener('add-influencer-success', event => {
                $('#modalAddInfluencer').modal('hide');
            });
        </script>
    @endpush
</div>
