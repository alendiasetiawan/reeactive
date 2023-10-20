<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    <x-items.breadcrumb>
        <x-slot name="mainPage">Dashboard</x-slot>
        <x-slot name="currentPage">Kuota Pendaftaran</x-slot>
    </x-items.breadcumb>

    <div class="row layout-top-spacing">
        @forelse ($this->membersPerCoach as $member)
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <x-widgets.payment-method>
                <x-slot name="title"><b class="text-primary">Coach {{ $member->nick_name }}</b></x-slot>
                <x-items.list-groups.label>
                    @foreach ($member->classes as $class)
                    <x-items.list-groups.item-label>
                        <x-slot name="title">{{ $class->day }}</x-slot>
                        <x-slot name="subTitle">
                            {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                        </x-slot>
                        <a wire:navigate href="{{ route('admin::member_in_class', [$class->id, $batchId]) }}">
                            <x-items.badges.light-success>
                                {{ $class->registrations->where('class_id', $class->id)->count() }} Member
                            </x-items.badges.light-success>
                        </a>
                    </x-items.list-groups.item-label>
                    @endforeach
                </x-items.list-groups.label>
            </x-widgets.payment-method>
        </div>
        @empty
        <x-items.alerts.light-danger>Tidak ada data yang bisa ditampilkan</x-items.alerts.light-danger>
        @endforelse
    </div>
</div>
