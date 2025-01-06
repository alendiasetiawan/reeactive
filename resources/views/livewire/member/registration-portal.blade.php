<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Portal Pendaftaran</x-slot:title>
        <x-slot:activePage>Portal Pendaftaran</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <!--Riwayat Jurnal-->
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">Program Reguler</h2>
                        <p class="card-text">Intensif dan berkelanjutan</p>
                    </div>
                    <a href="{{ route('member::renewal_registration') }}">
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
                        <p class="card-text">Kelas tidak terikat</p>
                    </div>
                    <a wire:navigate href="{{ route('member::open_class_registration') }}">
                        <div class="avatar bg-light-primary p-50 m-0">
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
