<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
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
                                @if (!$openForm)
                                    <button class="btn btn-success btn-sm" wire:click="requestClass">Request Kelas</button>
                                @else
                                    <a href="#" wire:click="closeForm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="widget-content general-info payment-info">
                            @if ($openForm)
                                <span>Silahkan isi data di bawah ini untuk mengajukan buka kelas baru</span>
                                <form class="mt-2">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <x-inputs.label>Hari</x-inputs.label>
                                            <x-inputs.basic type="text" placeholder="Contoh : Senin, Rabu, Jum'at" />
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <x-inputs.label>Waktu</x-inputs.label>
                                            <div class="form-group mb-0">
                                                <input id="timeFlatpickr" class="form-control form-control-sm flatpickr flatpickr-input active" type="text" placeholder="Select Date..">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                            <div class="list-group scroller4">
                                @foreach ($program->classes as $class)
                                <label class="list-group-item">
                                    <div class="d-flex w-100">
                                        <div class="billing-content">
                                            <div class="fw-bold">{{ $class->day }}</div>
                                            <p>{{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} -
                                                {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}</p>
                                        </div>
                                        <div class="billing-edit align-self-center ms-auto">
                                            <button class="btn btn-dark btn-sm">Edit</button>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach

    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/flatpickr/flatpickr.main.js') }}"></script>

    <script>
        document.addEventListener('livewire:navigated', () => {
        var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            defaultDate: "13:45",
        });
    });
    </script>
    @endpush
</div>
