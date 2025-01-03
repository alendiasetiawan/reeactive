<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Database Kelas Reguler</x-slot:title>
        <x-slot:activePage>Database Kelas Reguler</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Title and Filter-->
    <div class="row">
        <div class="col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Member Aktif <strong class="text-primary">{{ $batchName }}</strong></x-slot:cardTitle>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Cari Member</x-inputs.label>
                        <x-inputs.vuexy-basic placeholder="Ketik nama member disini..." wire:model.live.debounce.250ms="searchMember"/>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Pilih Kelas</x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live='filterClass'>
                            <x-inputs.vuexy-select-option value="0">--Semua--</x-inputs.vuexy-select-option>
                            @forelse ($classList as $class)
                            <x-inputs.vuexy-select-option value="{{ $class->id }}">{{ $class->day }}
                                ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                            </x-inputs.vuexy-select-option>
                            @empty
                            <x-inputs.select-option>Tidak ada data kelas</x-inputs.select-option>
                            @endforelse
                        </x-inputs.vuexy-select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <x-badges.basic color="primary">
                            Jumlah Member :
                            @if ($filterClass == 0)
                                {{ $activeMember }}
                            @else
                                {{ $activeMemberInClass }}
                            @endif
                        </x-badges.basic>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
    </div>
    <!--#Title and Filter-->

    <!--Member Lists-->
    <div class="row @if(!$isTablet) scroller5 @endif">
        <x-items.loading-dots wire:loading wire:target='searchMember'/>
        <x-items.loading-dots wire:loading wire:target='filterClass'/>
        @forelse ($this->members as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job>
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

        @if ($this->members->hasMorePages())
            <div class="col-12 text-center mb-2">
                <x-buttons.outline-primary wire:click='loadMore'>
                    Tampilkan Lagi
                </x-buttons.outline-primary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            </div>
        @endif

    </div>
    <!--#Member Lists-->
</div>
