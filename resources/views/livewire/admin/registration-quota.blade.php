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
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <x-widgets.payment-method>
                <x-slot name="title">Nama Coach</x-slot>
                <x-items.list-groups.label>
                    <x-items.list-groups.item-label>
                        <x-slot name="title">Senin, Selasa, Rabu</x-slot>
                        <x-slot name="subTitle">08:30 - 09:30</x-slot>
                        <x-items.badges.light-primary>10 Member</x-items.badges.light-primary>
                    </x-items.list-groups.item-label>
                    <x-items.list-groups.item-label>
                        <x-slot name="title">Senin, Selasa, Rabu</x-slot>
                        <x-slot name="subTitle">08:30 - 09:30</x-slot>
                        <x-items.badges.light-primary>10 Member</x-items.badges.light-primary>
                    </x-items.list-groups.item-label>
                </x-items.list-groups.label>
            </x-widgets.payment-method>
        </div>
    </div>
</div>
