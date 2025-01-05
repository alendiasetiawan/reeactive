<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Member per Kelas</x-slot:title>
        <x-slot:firstPage href="{{ route('admin::registration_quota') }}" wire:navigate>Data Kelas</x-slot:firstPage>
        <x-slot:activePage>Member per Kelas</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Title and Filter Data-->
    <div class="row">
        <div class="col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Data Member <b class="text-primary">{{ $batchQuery->batch_name }}</b></x-slot:cardTitle>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 mb-1 d-flex align-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-3 me-25"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Coach {{ $nickName }}
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mb-1 d-flex align-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock font-medium-3 me-25"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        {{ $classDetail->day }}
                        ({{ \Carbon\Carbon::parse($classDetail->start_time)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($classDetail->end_time)->format('H:i') }})
                    </div>
                    <div class="col-lg-4 col-md-3 col-12 mb-1 d-flex align-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users font-medium-3 me-25"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        @if ($filterLevel == 0 && $searchMember == NULL)
                            {{ $this->allMembersInClass }} Member
                        @else
                            {{ $this->membersInClass->count() }} Member
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Cari Member</x-inputs.label>
                        <x-inputs.vuexy-basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label class="d-flex justify-content-between">
                            Filter Level
                            @if ($searchMember != null || $filterLevel != null)
                                <a href="#" wire:navigate class="text-danger">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> Reset Filter</span>
                                </a>
                            @endif
                        </x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live="filterLevel">
                            <x-inputs.vuexy-select-option value="">--Semua--</x-inputs.vuexy-select-option>
                            <x-inputs.vuexy-select-option value="1">Beginner 1.0</x-inputs.vuexy-select-option>
                            <x-inputs.vuexy-select-option value="2">Beginner 2.0</x-inputs.vuexy-select-option>
                            <x-inputs.vuexy-select-option value="3">Intermediate</x-inputs.vuexy-select-option>
                        </x-inputs.vuexy-select>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
    </div>
    <!--#Title and Filter Data-->

    <!--List of Members-->
    <div class="row @if($this->membersInClass->count() > 3) scroller3 @endif">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <x-items.loading-dots class="mb-1" wire:loading wire:target='filterLevel'/>
        <!--#Loading Indicator-->

        @forelse ($this->membersInClass as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job wire:key='{{ $member->id }}'>
                    <x-slot:avatar>
                        <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="avatar" width="40" height="40">
                    </x-slot:avatar>
                    <x-slot:title>
                        {{ Str::excerpt($member->member_name, '', ['radius' => $isMobile ? 20 : 25]) }}
                    </x-slot:title>
                    <x-slot:subTitle>
                        @if ($member->program_name == 'Private 1 on 1')
                            <b class="text-primary">{{ $memer->program_name }}</b>
                        @elseif ($member->program_name == 'Buddy')
                            <b class="text-secondary">{{ $member->program_name }}</b>
                        @elseif ($member->program_name == 'Small Group')
                            <b class="text-info">{{ $member->program_name }}</b>
                        @elseif ($member->program_name == 'Special Case Small Group')
                            <b class="text-danger">{{ $member->program_name }}</b>
                        @elseif ($member->program_name == 'Large Group')
                            <b class="text-warning">{{ $member->program_name }}</b>
                        @else
                            <b class="text-success">{{ $member->program_name }}</b>
                        @endif
                        <b> - {{ $member->registration_category }}</b>
                    </x-slot:subTitle>
                    <x-slot:label>
                        <x-items.wa-icon href="https://wa.me/{{ $member->mobile_phone }}" width="25" height="25"/>
                    </x-slot:label>
                    <x-slot:headingContent>
                        {{ $member->day }} ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})
                    </x-slot:headingContent>
                    Level : {{ $member->level_name }}<br/>
                    @if ($member->medical_condition != NULL)
                        Catatan Medis : <br/> {{ $member->medical_condition }}
                    @else
                        Catatan Medis : -
                    @endif
                    <x-slot:actionButton>
                        <x-buttons.basic color="primary" class="w-100">Detail</x-buttons.basic>
                    </x-slot:actionButton>
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found/>
            </div>
        @endforelse

        @if ($this->membersInClass->hasMorePages())
            <div class="col-12 text-center mb-2">
                <x-buttons.outline-primary wire:click='loadMore' wire:loading.remove='loadMore'>
                    Tampilkan Lagi
                </x-buttons.outline-primary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            </div>
        @endif
    </div>
    <!--#List of Members-->
</div>
