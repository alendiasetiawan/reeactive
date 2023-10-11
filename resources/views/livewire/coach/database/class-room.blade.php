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
        @foreach ($this->programs as $program)
        @if ($program->classes->count() != 0)
            <div class="col-lg-6 col-12">
                <div class="pro-plan layout-spacing">
                    <div class="widget">
                        <div class="widget-heading">
                            <div class="task-info">
                                <h4 class="value">{{ $program->program_name }}</h4>
                            </div>
                            <div class="task-action">
                                <a wire:navigate href="{{ route('coach::class_room.create', $program->id) }}">
                                    <button class="btn btn-success btn-sm">Request Kelas</button>
                                </a>
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
                                            <button class="btn btn-dark btn-sm">Edit</button>
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

    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @if (session('send_request'))
        <script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'OK! Permohonan kelas sudah dikirim',
                showConfirmButton: false,
                timer: 2000
                })
        </script>
    @endif
    @endpush
</div>
