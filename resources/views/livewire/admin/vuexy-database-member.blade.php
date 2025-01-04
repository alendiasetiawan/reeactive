<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Database Member</x-slot:title>
        <x-slot:activePage>Database Member</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Filter Data-->
    <div class="row">
        <div class="col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>
                    Data Member Aktif <b class="text-primary">{{ $batchName }}</b>
                    <x-buttons.outline-primary class="btn-icon btn-sm" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </x-buttons.outline-primary>
                    <div class="dropdown-menu">
                        @foreach ($batches as $data)
                            <a href="#" class="dropdown-item d-flex align-items-center" wire:click='changeBatch({{ $data->id }})'>
                                {{ $data->batch_name }}
                            </a>
                        @endforeach
                    </div>
                </x-slot:cardTitle>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Cari Member</x-inputs.label>
                        <x-inputs.vuexy-basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-1 align-self-end">
                        <x-buttons.basic color="primary" data-bs-toggle="modal" data-bs-target="#downloadExcelModal" class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download font-medium-2 me-25"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            Excel
                        </x-buttons.basic>
                    </div>
                </div>

                <!--Filter Download Excel Modal-->
                <x-modals.slide-in id="downloadExcelModal" wire:ignore.self>
                    <x-slot:header>Download Excel <b class="text-primary">{{ $batchName }}</b></x-slot:header>

                    <!--Download Excel per Batch and Coach-->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-start">
                            <x-buttons.basic color="primary" data-bs-toggle="dropdown" class="btn-sm me-25 mb-1">
                                Excel Member
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </x-buttons.basic>
                            <div class="dropdown-menu">
                                @foreach ($batches as $data)
                                    <a href="{{ route('admin::excel_all_member', [$data->id]) }}" class="dropdown-item d-flex align-items-center" target="_blank">
                                        {{ $data->batch_name }}
                                    </a>
                                @endforeach
                            </div>

                            <x-buttons.basic color="outline-primary" data-bs-toggle="dropdown" class="btn-sm mb-1">
                                Excel Coach
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </x-buttons.basic>
                            <div class="dropdown-menu">
                                @foreach ($this->coaches as $coach)
                                    <a href="{{ route('admin::excel_per_coach', ['coachId' => $coach->id, 'batchId' => $batchId]) }}" class="dropdown-item" target="_blank">
                                        Coach {{ $coach->nick_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--#Download Excel per Batch and Coach-->

                    <!--Download Excel per Class-->
                    <form method="GET" action="{{ route('admin::excel_per_class') }}">
                        <div class="row">
                            <div class="col-12">
                                <small class="text-muted">Untuk download data member per jadwal, silahkan pilih data di bawah ini!</small>
                            </div>

                            <x-inputs.vuexy-basic value="{{ $batchId }}" name="batch_id" hidden/>
                            <div class="col-lg-6 col-12 mb-1">
                                <x-label>Coach</x-label>
                                <x-inputs.vuexy-select wire:model.live='selectedCoach' name="coach_id">
                                    <x-inputs.vuexy-select-option value="" disabled selected>--Pilih--</x-inputs.vuexy-select-option>
                                    @foreach ($this->coaches as $coach)
                                        <x-inputs.vuexy-select-option value="{{ $coach->id }}">Coach {{ $coach->nick_name }}</x-inputs.vuexy-select-option>
                                    @endforeach
                                </x-inputs.vuexy-select>
                            </div>
                            <div class="col-lg-6 col-12 mb-1">
                                <x-label>Kelas</x-label>
                                <x-inputs.vuexy-select wire:model.live='selectedClass' name="class_id">
                                    <x-inputs.vuexy-select-option value="" disabled selected>--Pilih--</x-inputs.vuexy-select-option>
                                    @if ($selectedCoach)
                                        @foreach ($this->classes as $class)
                                            <x-inputs.vuexy-select-option value="{{ $class->id }}">
                                                {{ $class->day }}
                                                ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                                            </x-inputs.vuexy-select-option>
                                        @endforeach
                                    @endif
                                </x-inputs.vuexy-select>
                            </div>
                            <div class="col-lg-6 col-12 mb-1 align-self-end">
                                <x-buttons.basic color="secondary" type="submit" :disabled="$selectedClass ? false : true">Download Excel</x-buttons.basic>
                            </div>
                        </div>
                    </form>
                    <!--#Download Excel per Class-->
                </x-modals.slide-in>
                <!--#Filter Download Excel Modal-->

            </x-cards.basic-card>
        </div>
    </div>
    <!--#Filter Data-->

    <div class="row @if(!$isTablet) scroller5 @endif">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <!--#Loading Indicator-->

        <!--List of Members-->
        @forelse ($this->membersActive as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job>
                    <x-slot:avatar>
                        <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="avatar" width="40" height="40">
                    </x-slot:avatar>
                    <x-slot:title>{{ Str::excerpt($member->member_name, '', ['radius' => $isMobile ? 20 : 25]) }}</x-slot:title>
                    <x-slot:subTitle>{{ $member->code }} - {{ $member->program_name }}</x-slot:subTitle>
                    <x-slot:label>
                        <x-items.wa-icon href="https://wa.me/{{ $member->mobile_phone }}" width="25" height="25"/>
                    </x-slot:label>
                    <x-slot:headingContent>
                        Coach {{ $member->nick_name }}
                    </x-slot:headingContent>
                    {{ $member->day }} ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }}) <br/>
                    {{ $member->level_name }} <br/>
                    Catatan Medis :
                    @if ($member->medical_condition != null) {{ $member->medical_condition }} @else - @endif
                    {{-- <x-slot:actionButton>
                        <x-buttons.basic color="primary" class="w-100">Detail</x-buttons.basic>
                    </x-slot:actionButton> --}}
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found/>
            </div>
        @endforelse
        <!--#List of Members-->

        @if ($this->membersActive->hasMorePages())
            <div class="col-12 text-center">
                <x-buttons.outline-secondary wire:click='loadMore'>Tampilkan Lagi</x-buttons.outline-secondary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            </div>
        @endif
    </div>
</div>
