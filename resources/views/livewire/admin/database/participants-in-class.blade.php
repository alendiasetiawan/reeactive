<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Peserta Kelas Lepasan</x-slot:title>
        <x-slot:firstPage href="{{ route('admin::lepasan_class') }}" wire:navigate>Data Kelas</x-slot:firstPage>
        <x-slot:activePage>Peserta Kelas Lepasan</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Title and Filter Data-->
    <div class="row">
        <div class="col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Data Peserta <b class="text-primary">{{ $this->classDetail->program_name }}</b></x-slot:cardTitle>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 mb-1 d-flex align-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-3 me-25"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Coach {{ $this->classDetail->nick_name }}
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 mb-1 d-flex align-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock font-medium-3 me-25"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        {{ \App\Helpers\TanggalHelper::convertImplodeDay($this->classDetail->day) }}
                        ({{ \Carbon\Carbon::parse($this->classDetail->start_time)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($this->classDetail->end_time)->format('H:i') }})
                    </div>
                    <div class="col-lg-4 col-md-3 col-12 mb-1 d-flex align-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users font-medium-3 me-25"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        {{ $this->totalParticipants }} Peserta
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Cari Member</x-inputs.label>
                        <x-inputs.vuexy-basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
    </div>
    <!--#Title and Filter Data-->

    <!--List of Members-->
    <div class="row @if($this->participantsInClass->count() > 3) scroller3 @endif">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <!--#Loading Indicator-->

        @forelse ($this->participantsInClass as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job wire:key='{{ $member->id }}'>
                    <x-slot:avatar>
                        <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="avatar" width="40" height="40">
                    </x-slot:avatar>
                    <x-slot:title>
                        {{ Str::excerpt($member->member_name, '', ['radius' => $isMobile ? 20 : 25]) }}
                    </x-slot:title>
                    <x-slot:subTitle>
                        Username : {{ $member->code }}
                    </x-slot:subTitle>
                    <x-slot:label>
                        <x-items.wa-icon href="https://wa.me/{{ $member->mobile_phone }}" width="25" height="25"/>
                    </x-slot:label>
                    <x-slot:headingContent>
                        {{ \App\Helpers\TanggalHelper::convertImplodeDay($member->day) }} ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})
                    </x-slot:headingContent>
                    Jumlah Sesi : {{ $member->classDates->count() }}<br/>
                    @foreach ($member->classDates as $class)
                        {{ $loop->iteration }}. {{ \Carbon\Carbon::parse($class->date)->isoFormat('dddd, D MMM Y') }} <br/>
                    @endforeach
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found/>
            </div>
        @endforelse

        @if ($this->participantsInClass->hasMorePages())
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
