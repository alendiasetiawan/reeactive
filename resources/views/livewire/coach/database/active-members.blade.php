<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('coach::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Database Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <h4>Data Member Aktif <b class="text-primary">{{ $batchName }}</b></h4>
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.basic type="text" placeholder="Ketik nama disini..." wire:model.live="searchMember"/>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.label>Filter Kelas</x-inputs.label>
            <x-inputs.select wire:model.live='filterClass'>
                <x-inputs.select-option value="0">--Semua--</x-inputs.select-option>
                @forelse ($classList as $class)
                <x-inputs.select-option value="{{ $class->id }}">{{ $class->day }}
                    ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                </x-inputs.select-option>
                @empty
                <x-inputs.select-option>Tidak ada data kelas</x-inputs.select-option>
                @endforelse
            </x-inputs.select>
        </div>
        <div class="mb-3">

        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <button type="button" class="btn btn-info">
                Jumlah Member <span class="badge bg-light text-dark ms-2">
                    @if ($filterClass == 0)
                        {{ $activeMember }}
                    @else
                    {{ $activeMemberInClass }}
                    @endif
                </span>
            </button>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($this->members as $member)
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <x-cards.user>
                    <x-slot name="userImage">
                        <x-cards.user-image src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"></x-cards.user-image>
                    </x-slot>
                    <x-slot name="userName">{{ $member->member_name }}</x-slot>
                    <x-slot name="userTitle">
                        @if ($member->program_name == 'Private 1 on 1')
                            <b class="text-primary">{{ $member->program_name }}</b>
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
                        <small> - {{ $member->registration_category }}</small>
                    </x-slot>
                    <x-slot name="icon" href="https://wa.me/{{ $member->mobile_phone }}" target="_blank">
                        <i class="fa-brands fa-whatsapp fa-xl" style="color: #19c502;"></i>
                    </x-slot>
                    <ul class="mb-0">
                        <li>{{ $member->level_name }}</li>
                        <li>{{ $member->day }} ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})</li>
                        <li>Catatan Medis :
                            @if ($member->medical_condition != NULL)
                                {{ $member->medical_condition }}
                            @else
                                -
                            @endif
                        </li>
                    </ul>
                    <x-slot name="bottomButton" href="#">Detail Member</x-slot>
                </x-cards.user>
            </div>
        @endforeach
        {{ $this->members->links() }}
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/custom.js') }}"></script>
    @endpush
</div>
