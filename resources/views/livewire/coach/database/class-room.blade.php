<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <x-items.breadcrumb>
        <x-slot name="mainPage">Dashboard</x-slot>
        <x-slot name="currentPage">Daftar Kelas</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-12 mb-2">
            <button class="btn btn-sm btn-primary" data-bs-target="#addClass" data-bs-toggle="modal" wire:click="addClass">Request Kelas</button>
        </div>
        @foreach ($this->programs as $program)
            @if ($program->classes->count() != 0)
                <div class="col-lg-6 col-12">
                    <div class="pro-plan layout-spacing">
                        <div class="widget">
                            <div class="widget-heading">
                                <div class="task-info">
                                    <h4 class="value">{{ $program->program_name }}</h4>
                                </div>
                            </div>

                            <div class="widget-content general-info payment-info">
                                <div class="list-group scroller4">
                                    @foreach ($program->classes as $class)
                                    <label class="list-group-item">
                                        <div class="d-flex w-100">
                                            <div class="billing-content">
                                                <div class="fw-bold">{{ $class->day }}</div>
                                                <p>{{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                                    @if ($class->class_status == 'Open')
                                                        <x-items.badges.solid-success>Aktif</x-items.badges.solid-success>
                                                    @elseif ($class->class_status == 'Pending')
                                                        <x-items.badges.solid-warning>Pending</x-items.badges.solid-warning>
                                                    @else
                                                        <x-items.badges.solid-dark>Tutup</x-items.badges.solid-dark>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="billing-edit align-self-center ms-auto">
                                                <button class="btn btn-dark btn-sm" data-bs-target="#editClass" data-bs-toggle="modal" wire:click="setValueClass('{{ Crypt::encrypt($class->id) }}')">Edit</button>
                                            </div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!--Modal Add Class-->
        <x-modals.form id="addClass" wire:ignore.self>
            <x-slot:modalHeader>Form Pengajuan Tambah Kelas</x-slot:modalHeader>
            <form wire:submit="sendRequest">
                <div class="row">
                    <div class="col-12 mb-3">
                        <x-inputs.label>Program</x-inputs.label>
                        <x-inputs.select wire:model.live.debounce.500ms='selectedProgram'>
                            <x-inputs.select-option value="null" selected disabled>--Pilih--</x-inputs.select-option>
                            @foreach ($listPrograms as $program)
                                <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}</x-inputs.select-option>
                            @endforeach
                        </x-inputs.select>
                    </div>

                    <div class="col-12 mb-3">
                        <x-inputs.label>Hari</x-inputs.label>
                        <x-inputs.basic placeholder="Senin, Rabu, Jum'at" wire:model.live.debounce.500ms='day'/>
                    </div>

                    <div class="col-12 mb-3">
                        <x-inputs.label>Waktu Mulai</x-inputs.label>
                        <x-inputs.basic placeholder="09:00" wire:model.live.debounce.500ms='startTime'/>
                    </div>

                    <div class="col-12 mb-3">
                        <x-inputs.label>Waktu Selesai</x-inputs.label>
                        <x-inputs.basic placeholder="10:00" wire:model.live.debounce.500ms='endTime'/>
                    </div>

                    <div class="col-12 mb-3">
                        <x-inputs.label>Link Group Whatsapp</x-inputs.label>
                        <x-inputs.basic wire:model.live.debounce.250ms='linkWa'/>
                    </div>

                    <div class="col-12">
                        <x-buttons.solid-primary type="submit" :disabled="$isSubmitActive ? false : true">Kirim</x-buttons.solid-primary>
                        <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Batal</x-buttons.outline-dark>
                    </div>
                </div>
            </form>
        </x-modals.form>
        <!--#Modal Add Class-->

        <!--Modal Edit Kelas-->
        <x-modals.form id="editClass" wire:ignore.self>
            <x-slot:modalHeader>Form Edit Kelas</x-slot:modalHeader>
            @if ($isClassFound)
                <form wire:submit="editClass">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <x-inputs.label>Program</x-inputs.label>
                            <x-inputs.basic wire:model='programName' readonly/>
                        </div>

                        <div class="col-12 mb-3">
                            <x-inputs.label>Hari</x-inputs.label>
                            <x-inputs.basic placeholder="Senin, Rabu, Jum'at" wire:model.live.debounce.500ms='day'/>
                        </div>

                        <div class="col-12 mb-3">
                            <x-inputs.label>Waktu Mulai</x-inputs.label>
                            <x-inputs.basic placeholder="09:00" wire:model.live.debounce.500ms='startTime'/>
                        </div>

                        <div class="col-12 mb-3">
                            <x-inputs.label>Waktu Selesai</x-inputs.label>
                            <x-inputs.basic placeholder="10:00" wire:model.live.debounce.500ms='endTime'/>
                        </div>

                        <div class="col-12 mb-3">
                            <x-inputs.label>Link Group Whatsapp</x-inputs.label>
                            <x-inputs.basic wire:model.live.debounce.250ms='linkWa'/>
                        </div>

                        <div class="col-12 mb-3">
                            <span>Data kelas yang diubah akan membuat statusnya menjadi <b class="text-primary">Pending</b>, untuk kemudian diverifikasi oleh admin</span>
                        </div>
                        <div class="col-12">
                            <x-buttons.solid-primary>Simpan</x-buttons.solid-primary>
                            <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Batal</x-buttons.outline-dark>
                        </div>
                    </div>
                </form>
            @endif
        </x-modals.form>
        <!--#Modal Edit Kelas-->
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    <script data-navigate-once>
        window.addEventListener('request-sent', event => {
            $('#addClass').modal('hide');
        });
    </script>

    <script>
        window.addEventListener('request-sent', event => {
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Permohonan kelas sudah dikirim',
            showConfirmButton: false,
            timer: 2000
            });

            setTimeout( () => {
                location.reload();
            }, 2000);
        });
    </script>

    <script data-navigate-once>
        window.addEventListener('class-updated', event => {
            $('#editClass').modal('hide');
        });
    </script>

    <script>
        window.addEventListener('class-updated', event => {
            Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Data kelas berhasil diubah',
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
