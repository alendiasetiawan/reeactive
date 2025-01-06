<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Portal Database Member</x-slot:title>
        <x-slot:activePage>Portal Database Member</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <!--Riwayat Jurnal-->
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0">Program Reguler</h2>
                        <p class="card-text">Data member aktif</p>
                    </div>
                    <a href="{{ route('coach::active_members') }}">
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
                        <p class="card-text">Data member aktif</p>
                    </div>
                    <a wire:navigate href="{{ route('coach::open_class_member') }}">
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
