<div>
    @push('customCss')
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Request Class</x-slot>
    </x-items.breadcumb>

    <div class="row layout-top-spacing match-height">
        <span class="text-muted mb-2">Berikut ini adalah daftar coach yang mengajukan penambahan kelas baru</span>
        @forelse ($this->listClasses as $class)
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <x-cards.user>
                    <x-slot:userName>Coach {{ $class->coach->coach_name }}</x-slot:userName>
                    <x-slot:userTitle>{{ \Carbon\Carbon::parse($class->created_at)->isoFormat('D MMMM Y') }}</x-slot:userTitle>
                    Program : {{ $class->program->program_name }} <br/>
                    Hari : {{ $class->day }}<br/>
                    Waktu : {{ $class->start_time }} - {{ $class->end_time }}<br/>
                    Renewal :
                    @if ($class->class_status == 'Pending')
                        <b class="text-warning">
                            {{ $class->class_status }}
                        </b>
                    @else
                        <b class="text-success">
                            {{ $class->class_status }}
                        </b>
                    @endif
                    <br/>
                    New Member :
                    @if ($class->class_status_eksternal == 'Pending')
                        <b class="text-warning">
                            {{ $class->class_status_eksternal }}
                        </b>
                    @else
                        <b class="text-success">
                            {{ $class->class_status_eksternal }}
                        </b>
                    @endif
                    <x-slot:bottomButton wire:click="approve({{ $class->id }})" data-bs-target="#modalApprove" data-bs-toggle="modal">
                        Proses
                    </x-slot:bottomButton>
                </x-cards.user>
            </div>
        @empty
            <div class="col-12">
                <x-items.alerts.light-success>
                    Mohon maaf, tidak ada data yang bisa ditampilkan
                </x-items.alerts.light-success>
            </div>
        @endforelse
    </div>

    <!--Modal Proccess Request-->
    <x-modals.form wire:ignore.self id="modalApprove">
        <x-slot:modalHeader>Approval Penambahan Kelas</x-slot:modalHeader>
        <form wire:submit='proccessRequest'>
            <div class="row">
                <div class="col-lg-6 col-12 mb-2">
                    <h6>Coach</h6>
                    <span>{{ $detailClass?->coach->coach_name }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <h6>Program</h6>
                    <span>{{ $detailClass?->program->program_name }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <h6>Hari</h6>
                    <span>{{ $detailClass?->day }}</span>
                </div>
                <div class="col-lg-6 col-12 mb-2">
                    <h6>Waktu</h6>
                    <span>{{ $detailClass?->start_time }} - {{ $detailClass?->end_time }}</span>
                </div>
                <div class="col-12 mb-3">
                    <h6>Link WA</h6>
                    <a href="{{ $detailClass?->link_wa }}" target="_blank">{{ $detailClass?->link_wa }}</a>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Untuk New Member</x-inputs.label>
                    <x-inputs.select wire:model='statusNewMember'>
                        <x-inputs.select-option value="Open">Open</x-inputs.select-option>
                        <x-inputs.select-option value="Close">Close</x-inputs.select-option>
                        <x-inputs.select-option value="Pending">Pending</x-inputs.select-option>
                    </x-inputs.select>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <x-inputs.label>Untuk Renewal</x-inputs.label>
                    <x-inputs.select wire:model='statusRenewal'>
                        <x-inputs.select-option value="Open">Open</x-inputs.select-option>
                        <x-inputs.select-option value="Close">Close</x-inputs.select-option>
                        <x-inputs.select-option value="Pending">Pending</x-inputs.select-option>
                    </x-inputs.select>
                </div>
                <div class="col-12">
                    <x-buttons.solid-primary type="submit">Simpan</x-buttons.solid-primary>
                    <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Tutup</x-buttons.outline-dark>
                </div>
            </div>
        </form>
    </x-modals.form>
    <!--#Modal Proccess Request-->

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    <script data-navigate-once>
        window.addEventListener('class-approved', event => {
            $('#modalApprove').modal('hide');
        });
    </script>

    <script>
        window.addEventListener('class-approved', event => {
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Approval kelas berhasil',
            showConfirmButton: false,
            timer: 2000
            });

            setTimeout( () => {
                location.reload();
            }, 2000);
        });
    </script>
    @endpush
</div>
