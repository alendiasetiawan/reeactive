<div>
    <div class="row layout-top-spacing">
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.wallet>
                <x-slot name="header">Data Member Aktif</x-slot>
                <x-slot name="mainTitle">{{ $activeParticipants }} Member</x-slot>
                <x-slot name="info"><b class="text-primary">Coach {{ Auth::user()->full_name }}</b></x-slot>
                <x-slot name="buttonActionOne">
                    <a wire:navigate href="{{ route('trainer::active_member') }}">
                        <x-buttons.solid-primary>Data Member</x-buttons.solid-primary>
                    </a>
                </x-slot>
                {{-- <x-slot name="buttonActionTwo">
                    <a wire:navigate href="{{ route('coach::class_room') }}">
                        <x-buttons.solid-info>Data Kelas</x-buttons.solid-info>
                    </a>
                </x-slot> --}}
                <x-items.list-groups.advance>
                    @foreach ($members as $member)
                        @if ($loop->index <= 1)
                            <x-items.list-groups.item-advance>
                                <x-slot name="title">{{ $member->program_name }}</x-slot>
                                <x-slot name="subTitle">
                                    ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})
                                </x-slot>
                                <x-slot name="info">
                                    {{ $member->workshopRegistrations->count() }} Member
                                </x-slot>
                            </x-items.list-groups.item-advance>
                        @endif
                    @endforeach
                </x-items.list-groups.advance>
            </x-cards.wallet>
        </div>
    </div>
</div>
