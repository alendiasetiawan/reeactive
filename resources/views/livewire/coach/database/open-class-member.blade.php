<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Database Kelas Lepasan</x-slot:title>
        <x-slot:activePage>Database Peserta Kelas Lepasan</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Filter Data-->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mb-1">
            <x-inputs.label>Cari Peserta</x-inputs.label>
            <x-inputs.vuexy-basic placeholder="Ketik nama disini..." wire:model.live.debounce.250ms="searchMember"/>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-1">
            <x-inputs.label>Pilih Program</x-inputs.label>
            <x-inputs.vuexy-select wire:model.live='filterProgram'>
                <x-inputs.vuexy-select-option value="0">Semua</x-inputs.vuexy-select-option>
                @foreach ($programList as $program)
                    <x-inputs.vuexy-select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.vuexy-select-option>
                @endforeach
            </x-inputs.vuexy-select>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-1">
            <x-inputs.label>Pilih Kelas</x-inputs.label>
            <x-inputs.vuexy-select wire:model.live='filterClass'>
                <x-inputs.vuexy-select-option value="0">Semua</x-inputs.vuexy-select-option>
                @foreach ($classList as $class)
                    <x-inputs.vuexy-select-option value="{{ $class->id }}">
                        {{ \App\Helpers\TanggalHelper::convertImplodeDay($class->day) }}
                        ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                    </x-inputs.vuexy-select-option>
                @endforeach
            </x-inputs.vuexy-select>
        </div>
        @if ($searchMember || $filterClass || $filterProgram)
            <div class="col-lg-2 col-md-6 col-6 mb-1">
                <a href="#" wire:navigate>
                    <small><b class="text-danger">x Reset Filter</b></small>
                </a>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            <x-badges.basic color="primary" class="me-25">Total Peserta : {{ $this->participants }}</x-badges.basic>
            <x-badges.basic color="warning" class="me-25">Proses : {{ $this->notStarted }}</x-badges.basic>
            <x-badges.basic color="success" class="me-25">Selesai : {{ $startedParticipants }}</x-badges.basic>
        </div>
    </div>
    <!--#Filter Data-->

    <!--Member List-->
    <div class="row mt-1">
        <x-vuexy.items.loading-dots wire:loading wire:target='searchMember'/>
        <x-vuexy.items.loading-dots wire:loading wire:target='filterClass'/>
        <x-vuexy.items.loading-dots wire:loading wire:target='filterProgram'/>

        @forelse ($this->allParticipants as $participant)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job>
                    <x-slot:avatar>
                        <img src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}" alt="avatar" width="40" height="40">
                    </x-slot:avatar>
                    <x-slot:title>
                        {{ Str::excerpt($participant->member_name, '', ['radius' => $isMobile ? 20 : 25]) }}
                    </x-slot:title>
                    <x-slot:subTitle>{{ $participant->program_name }}</x-slot:subTitle>
                    <x-slot:label>
                        <x-items.wa-icon href="https://wa.me/{{ $participant->mobile_phone }}" width="25" height="25"/>
                    </x-slot:label>
                    <x-slot:headingContent>
                        {{ \App\Helpers\TanggalHelper::convertImplodeDay($participant->day) }}
                        ({{ \Carbon\Carbon::parse($participant->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($participant->end_time)->format('H:i') }})
                    </x-slot:headingContent>
                    Jumlah Sesi : {{ $participant->classDates->count() }} <br/>
                    @foreach ($participant->classDates as $date)
                        {{ $loop->iteration }}. {{ \Carbon\Carbon::parse($date->date)->isoFormat('dddd, D MMMM Y') }} <br/>
                    @endforeach
                    <x-slot:actionButton>
                        @php
                            $count = $participant->classDates->where('date', '>=', date('Y-m-d'))->count();
                        @endphp
                        @if ($count == 0)
                        <x-buttons.basic color="success" class="w-100" disabled>Selesai</x-buttons.basic>
                        @else
                        <x-buttons.basic color="warning" class="w-100" disabled>Proses</x-buttons.basic>
                        @endif
                    </x-slot:actionButton>
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found/>
            </div>
        @endforelse
    </div>
    <!--#Member List-->
</div>
