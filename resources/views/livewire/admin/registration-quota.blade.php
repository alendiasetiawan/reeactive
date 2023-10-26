<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Kuota Pendaftaran</x-slot>
    </x-items.breadcumb>

    <div class="row layout-top-spacing">
        @forelse ($this->membersPerCoach as $member)
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="widget widget-table-one">
                <div class="widget-heading">
                    <h5 class="text-primary"><b>Coach {{ $member->nick_name }}</b></h5>
                </div>
                <div class="widget-content">
                    @foreach ($member->classes as $class)
                    <div class="transactions-list" wire:key='{{ $class->id }}'>
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-name">
                                    <h4>{{ $class->day }}
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#changeClassStatus{{ $class->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM135 241c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l87 87 87-87c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L273 345c-9.4 9.4-24.6 9.4-33.9 0L135 241z"/></svg>
                                        </a>
                                    </h4>
                                    <p class="meta-date">
                                        {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                    </p>
                                    <small>
                                        New:
                                        @if ($class->class_status_eksternal == 'Open')
                                            <b class="text-success">Open</b>
                                        @else
                                            <b class="text-danger">Close</b>
                                        @endif
                                        |
                                        Renew:
                                        @if ($class->class_status == 'Open')
                                            <b class="text-success">Open</b>
                                        @else
                                            <b class="text-danger">Close</b>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="t-rate rate-dec">
                                @php
                                    $registeredMember = $class->registrations->where('class_id', $class->id)->count();
                                @endphp
                                <a wire:navigate href="{{ route('admin::member_in_class', [$class->id, $batchId, $member->nick_name]) }}">
                                    <span
                                    @if ($registeredMember >= 11)
                                        class="text-success"
                                    @elseif ($registeredMember >= 6)
                                        class="text-warning"
                                    @else
                                        class="text-danger"
                                    @endif>
                                        Member : {{ $registeredMember }}
                                        <svg xmlns="http://www.w3.org/2000/svg" height="0.625em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32h82.7L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V32c0-17.7-14.3-32-32-32H320zM80 32C35.8 32 0 67.8 0 112V432c0 44.2 35.8 80 80 80H400c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32V432c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16H192c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/></svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Change Class Status --}}
                    @php
                        $statusNewMember = $class->class_status_eksternal;
                        $statusRenewal = $class->class_status;
                        $classId = $class->id;
                        $coach = $member->nick_name;
                        $day = $class->day;
                        $start = $class->start_time;
                        $end = $class->end_time;
                    @endphp
                    <x-modals.zoomUp id="changeClassStatus{{ $class->id }}">
                        <x-slot name="modalTitle">Ubah Status Kelas</x-slot>
                        <livewire:admin.registrations.form-class-status :statusNewMember='$statusNewMember' :statusRenewal='$statusRenewal' :classId='$classId' :coach='$coach' :day='$day' :start='$start' :end='$end'/>
                    </x-modals.zoomUp>
                    @endforeach
                </div>
            </div>
        </div>
        @empty
        <x-items.alerts.light-danger>Tidak ada data yang bisa ditampilkan</x-items.alerts.light-danger>
        @endforelse
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @if (session('saveClass'))
        <script>
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'OK! Status kelas berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
                })
        </script>
    @endif
    @endpush
</div>
