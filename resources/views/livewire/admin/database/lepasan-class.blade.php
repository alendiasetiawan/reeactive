<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Data Kelas Lepasan</x-slot:title>
        <x-slot:activePage>Data Kelas Lepasan</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Filter Data-->
    <div class="row mb-1">
        <div class="col-lg-4 col-md-6 col-12">
            <x-inputs.label class="d-flex justify-content-between">
                Coach
                @if ($selectedCoach != '')
                <a href="#" wire:navigate>
                    <span class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        Reset Filter
                    </span>
                </a>
                @endif
            </x-inputs.label>
            <x-inputs.vuexy-select wire:model.live='selectedCoach'>
                <x-inputs.vuexy-select-option value="" disabled>--Pilih--</x-inputs.vuexy-select-option>
                @foreach ($regulerCoaches as $coach)
                    <x-inputs.vuexy-select-option value="{{ $coach->id }}">Coach {{ $coach->nick_name }}</x-inputs.vuexy-select-option>
                @endforeach
            </x-inputs.vuexy-select>
        </div>
    </div>
    <!--#Filter Data-->

    <!--List of Classes-->
    <div class="row">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='selectedCoach'/>
        <!--#Loading Indicator-->

        @forelse ($this->membersPerCoach as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.employee>
                    <x-slot:header>
                        Coach {{ $member->nick_name }}
                        <x-badges.light-badge color="primary">{{ $member->classes->count() }} Kelas</x-badges.light-badge>
                    </x-slot:header>
                    <div class="scroller">
                        @foreach ($member->classes as $class)
                            <x-cards.employee-task wire:key='{{ $class->id }}'>
                                <x-slot:title>
                                    {{ \App\Helpers\TanggalHelper::convertImplodeDay($class->day) }}
                                </x-slot:title>
                                <x-slot:subTitle>
                                    {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                                    @if ($class->link_wa != null)
                                        <x-items.wa-icon href="{{ $class->link_wa }}" />
                                    @endif
                                    <br/>
                                    @php
                                        $registeredMember = $class->specialRegistrations
                                        ->where('payment_status', 'Done')
                                        ->where('class_id', $class->id)
                                        ->count();
                                    @endphp
                                    <a wire:navigate href="{{ route('admin::participants_in_class', ['classId' => $class->id]) }}">
                                        <small class="text-primary">
                                            {{ $class->program_name }} - {{ $registeredMember }} Peserta
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link font-medium-1 align-self-end"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                        </small>
                                    </a>
                                </x-slot:subTitle>
                                <x-slot:label>
                                    <span class="{{ $class->class_status_eksternal == 'Open' ? 'text-success' : 'text-danger' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status New Member">{{ $class->class_status_eksternal }}</span>
                                    |
                                    <span class="{{ $class->class_status == 'Open' ? 'text-success' : 'text-danger' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status Renewal">{{ $class->class_status }}</span>
                                </x-slot:label>
                                <x-slot:action>
                                    <a href="#" data-bs-toggle='modal' data-bs-target='#changeClassStatus{{ $class->id }}' wire:click='setClassId({{ $class->id }})'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-medium-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                </x-slot:action>
                            </x-cards.employee-task>

                            {{-- Modal Change Class Status --}}
                            @php
                                $statusNewMember = $class->class_status_eksternal;
                                $statusRenewal = $class->class_status;
                                $classId = $class->id;
                                $coach = $member->nick_name;
                                $day = \App\Helpers\TanggalHelper::convertImplodeDay($class->day);
                                $start = $class->start_time;
                                $end = $class->end_time;
                                $programName = $class->program_name
                            @endphp
                            <x-modals.top-center id="changeClassStatus{{ $class->id }}" wire:ignore.self>
                                <x-slot:header>Ubah Status Kelas</x-slot:header>
                                <x-slot:content>
                                    <form wire:submit='save'>
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                Program : {{ $programName }} <br/>
                                                Coach : {{ $coach }} <br>
                                                Hari : {{ $day }} <br>
                                                Waktu : {{ \Carbon\Carbon::parse($start)->format('H:i') }} - {{ \Carbon\Carbon::parse($end)->format('H:i') }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <x-inputs.basic wire:model='selectedClassId' hidden/>
                                            <div class="col-lg-6 col-12 mb-2">
                                                <x-inputs.label>Untuk <b class="text-primary">New Member</b></x-inputs.label>
                                                <x-inputs.vuexy-select wire:model.live='setNewMember'>
                                                    <x-inputs.vuexy-select-option>{{ $statusNewMember }}</x-inputs.vuexy-select-option>
                                                    @if ($statusNewMember != 'Open')
                                                    <x-inputs.vuexy-select-option>Open</x-inputs.vuexy-select-option>
                                                    @endif
                                                    @if ($statusNewMember != 'Close')
                                                    <x-inputs.vuexy-select-option>Close</x-inputs.vuexy-select-option>
                                                    @endif
                                                </x-inputs.vuexy-select>
                                            </div>

                                            <div class="col-lg-6 col-12 mb-2">
                                                <x-inputs.label>Untuk <b class="text-secondary">Renewal Member</b></x-inputs.label>
                                                <x-inputs.vuexy-select wire:model.live='setRenewal'>
                                                    <x-inputs.vuexy-select-option>{{ $statusRenewal }}</x-inputs.vuexy-select-option>
                                                    @if ($statusRenewal != 'Open')
                                                    <x-inputs.vuexy-select-option>Open</x-inputs.vuexy-select-option>
                                                    @endif
                                                    @if ($statusRenewal != 'Close')
                                                    <x-inputs.vuexy-select-option>Close</x-inputs.vuexy-select-option>
                                                    @endif
                                                </x-inputs.vuexy-select>
                                            </div>

                                            <div class="col-12">
                                                <x-buttons.basic color="primary" type="submit">Simpan</x-buttons.basic>
                                                <x-buttons.outline-dark type="button" data-bs-dismiss="modal">Batal</x-buttons.outline-dark>
                                            </div>
                                        </div>
                                    </form>
                                </x-slot:content>
                            </x-modals.top-center>
                        @endforeach
                    </div>
                </x-cards.employee>
            </div>
        @empty

        @endforelse
    </div>
    <!--#List of Classes-->

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
        <script data-navigate-once>
            window.addEventListener('class-status-updated', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    '👋Status kelas berhasil di update',
                    'OK!',
                    {
                        showMethod: 'slideDown',
                        hideMethod: 'slideUp',
                        closeButton: true,
                        tapToDismiss: true,
                        rtl: isRtl
                    }
                    );
                }, 500);
            });
        </script>
    @endpush
</div>
