<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('coach::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Database Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <h4>Data Member Aktif <b class="text-primary">{{ $batchName }}</b></h4>
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.basic type="text" placeholder="Cari nama member..." wire:model.live="searchMember"/>
        </div>
        <div class="mt-3 d-md-none d-lg-none d-xl-none">

        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <button type="button" class="btn btn-info">
                Jumlah Member <span class="badge bg-light text-dark ms-2">4</span>
            </button>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($members as $member)
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <x-cards.user>
                    <x-slot name="userImage">
                        <x-cards.user-image src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"></x-cards.user-image>
                    </x-slot>
                    <x-slot name="userName">{{ $member->member_name }}</x-slot>
                    <x-slot name="userTitle">
                        @if ($member->id == 1)
                            <b class="text-primary">{{ $member->program_name }}</b>
                        @elseif ($member->id == 2)
                            <b class="text-secondary">{{ $member->program_name }}</b>
                        @elseif ($member->id == 3)
                            <b class="text-info">{{ $member->program_name }}</b>
                        @elseif ($member->id == 4)
                            <b class="text-danger">{{ $member->program_name }}</b>
                        @elseif ($member->id == 5)
                            <b class="text-warning">{{ $member->program_name }}</b>
                        @else
                            <b class="text-success">{{ $member->program_name }}</b>
                        @endif
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
        {{ $members->links() }}
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/custom.js') }}"></script>
    @endpush
</div>
