<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Portal Manajemen Kelas</x-slot:title>
        <x-slot:activePage>Portal Manajemen Kelas</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <!--Riwayat Jurnal-->
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">Program Reguler</h2>
                        <p class="card-text">Jumlah Kelas : {{ $totalRegulerClass }}</p>
                    </div>
                    <a href="{{ route('admin::registration_quota') }}" wire:navigate>
                        <div class="avatar bg-light-danger p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='chevrons-right' class="font-medium-5"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!--Riwayat Jurnal-->
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">Kelas Lepasan</h2>
                        <p class="card-text">Jumlah Kelas : {{ $totalLepasanClass }}</p>
                    </div>
                    <a wire:navigate href="{{ route('admin::lepasan_class') }}">
                        <div class="avatar bg-light-success p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='chevrons-right' class="font-medium-5"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
