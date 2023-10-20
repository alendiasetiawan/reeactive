<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::registration_quota') }}">
            <em class="text-info">
            Kuota Kelas
            </em>
        </x-slot>
        <x-slot name="currentPage">Member Per Kelas</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-12">
            <h2>Data Member Per Kelas</h2>
        </div>
        <div class="col-lg-6 col-12">
            <x-buttons.outline-primary>Coach Mala</x-buttons.outline-primary>
            <div class="mb-2 d-lg-none d-xl-none">

            </div>
            <x-buttons.outline-secondary>Senin, Rabu, Jum'at 08:30 - 09:30</x-buttons.outline-secondary>
        </div>
    </div>
</div>
