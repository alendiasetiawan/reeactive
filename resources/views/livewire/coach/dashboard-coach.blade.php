<div>
    @push('customCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
        <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row layout-top-spacing">
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.wallet>
                <x-slot name="header">Data Member Aktif</x-slot>
                <x-slot name="mainTitle">{{ $activeMember }} Member</x-slot>
                <x-slot name="info"><b class="text-primary">{{ $batchName }} - Coach {{ Auth::user()->full_name }}</b></x-slot>
                <x-slot name="buttonActionOne">
                    <a wire:navigate href="{{ route('coach::active_members') }}">
                        <x-buttons.solid-primary>Data Member</x-buttons.solid-primary>
                    </a>
                </x-slot>
                <x-slot name="buttonActionTwo">
                    <a wire:navigate href="{{ route('coach::class_room') }}">
                        <x-buttons.solid-info>Data Kelas</x-buttons.solid-info>
                    </a>
                </x-slot>
                <x-items.list-groups.advance>
                    @foreach ($membersInClass as $member)
                        @if ($loop->index <= 1)
                            <x-items.list-groups.item-advance>
                                <x-slot name="title">{{ $member->day }}</x-slot>
                                <x-slot name="subTitle">
                                    ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})
                                </x-slot>
                                <x-slot name="info">
                                    {{ $member->registrations->count() }} Member
                                </x-slot>
                            </x-items.list-groups.item-advance>
                        @endif
                    @endforeach
                </x-items.list-groups.advance>
                <x-slot name="callToAction">
                    <x-buttons.solid-secondary data-bs-toggle="modal" data-bs-target="#allClass" class="w-100 mt-2">
                        Lihat Selengkapnya</x-buttons.solid-secondary>
                </x-slot>
            </x-cards.wallet>
            <!--Modal Member Class-->
            <x-modals.zoomUp id="allClass">
                <x-slot name="modalTitle">Info Member Per Kelas <b class="text-primary">{{ $batchName }}</b></x-slot>
                <x-items.list-groups.label>
                    @foreach ($membersInClass as $member)
                        <x-items.list-groups.item-label>
                            <x-slot name="title">{{ $member->day }}</x-slot>
                            <x-slot name="subTitle">
                                ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})</x-slot>
                            <x-items.badges.solid-info>{{ $member->registrations->count() }} Member</x-items.badges.solid-info>
                        </x-items.list-groups.item-label>
                    @endforeach
                </x-items.list-groups.label>
            </x-modals.zoomUp>
            <!--#Modal Member Class-->
        </div>
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/flatpickr/flatpickr.main.js') }}" data-navigate-once></script>
    <script>
        document.addEventListener('livewire:navigating', () => {
        var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:s",
            defaultDate: "",
        });
    });
    </script>

    <script>
        document.addEventListener('livewire:navigating', () => {
        var f4 = flatpickr(document.getElementById('timeFlatpickrDua'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:s",
            defaultDate: "",
        });
    });
    </script>
    @endpush
</div>
