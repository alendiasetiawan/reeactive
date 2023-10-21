<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
    <link href="{{ asset('template/src/plugins/src/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
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
            <h4>Data Member Per Kelas <b class="text-primary">{{ $batchQuery->batch_name }}</b></h4>
        </div>
        <div class="col-lg-6 col-12">
            <x-buttons.outline-primary><b>Coach {{ $nickName }}</b></x-buttons.outline-primary>
            <div class="mb-2 d-lg-none d-xl-none">

            </div>
            <x-buttons.outline-secondary>
                <b>
                {{ $classDetail->day }}
                ({{ \Carbon\Carbon::parse($classDetail->start_time)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($classDetail->end_time)->format('H:i') }})
                </b>
            </x-buttons.outline-secondary>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.basic type="text" placeholder="Ketik nama disini..." wire:model.live="searchMember"/>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.label>Filter Level</x-inputs.label>
            <x-inputs.select wire:model.live='filterLevel'>
                <x-inputs.select-option value="0">--Semua--</x-inputs.select-option>
                <x-inputs.select-option value="1">Beginner 1.0</x-inputs.select-option>
                <x-inputs.select-option value="2">Beginner 2.0</x-inputs.select-option>
                <x-inputs.select-option value="3">Intermediate</x-inputs.select-option>
            </x-inputs.select>
        </div>
        <div class="mt-2">

        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <button type="button" class="btn btn-info">
                Jumlah Member <span class="badge bg-light text-dark ms-2">
                    @if ($filterLevel == 0 && $searchMember == NULL)
                        {{ $this->allMembersInClass->count() }}
                    @else
                    {{ $this->membersInClass->count() }}
                    @endif
                </span>
            </button>
        </div>
    </div>

    {{-- Card Members --}}
    <div class="row mt-3">
        @forelse ($this->membersInClass as $member)
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <x-cards.user>
                <x-slot name="userImage">
                    <x-cards.user-image src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"></x-cards.user-image>
                </x-slot>
                <x-slot name="userName">{{ $member->member_name }}</x-slot>
                <x-slot name="userTitle">
                    @if ($member->id == 1)
                        <b class="text-primary">{{ $member->program_name }}</b>
                    @elseif ($member->id == 2)
                        <b class="text-secondary">{{ $member->program_name }}</b>
                    @elseif ($member->id == 3)
                        <b class="text-info">{{ $member->program_name }}</b>
                    @elseif ($member->id == 4)
                        <b class="text-danger">{{ $member->program_name }}</b>
                    @elseif ($member->id == 5)
                        <b class="text-warning">{{ $member->program_name }}</b>
                    @else
                        <b class="text-success">{{ $member->program_name }}</b>
                    @endif
                    <small> - {{ $member->registration_category }}</small>
                </x-slot>
                <x-slot name="icon" href="https://wa.me/{{ $member->mobile_phone }}" target="_blank">
                    <i class="fa-brands fa-whatsapp fa-xl" style="color: #19c502;"></i>
                </x-slot>
                <ul class="mb-0 mt-0">
                    <li>{{ $member->level_name }}</li>
                    <li>{{ $member->day }} ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})</li>
                    <li>Catatan Medis :
                        @if ($member->medical_condition != NULL)
                            {{ $member->medical_condition }}
                        @else
                            -
                        @endif
                    </li>
                </ul>
                <x-slot name="bottomButton" data-bs-toggle="modal" data-bs-target="#editMember{{ $member->id }}">Edit Member</x-slot>
            </x-cards.user>
            {{-- Modal Edit Member --}}
            <x-modals.form id="editMember{{ $member->id }}">
                <x-slot name="modalHeader">Edit Data Member</x-slot>
                <livewire:admin.registrations.form-edit-member />
            </x-modals.form>
        </div>
        @empty
        <div class="col-12">
            <x-items.alerts.light-danger>Upss.. tidak ada data yang bisa ditampilkan</x-items.alerts.light-danger>
        </div>
        @endforelse
    </div>

    {{-- Load More Button --}}
    @if ($filterLevel == 0 && $searchMember == '')
        @if ($this->allMembersInClass->count() > $this->membersInClass->count())
        <div class="row">
            <div class="col-lg-6 col-12">
                <x-buttons.solid-primary wire:click='loadMore' wire:loading.attr='disabled'>
                    Tampilkan Lagi...
                </x-buttons.solid-primary>
                <div wire:loading.class="spinner-border spinner-border-reverse align-self-center loader-sm text-primary">.</div>
            </div>
        </div>
        @endif
    @endif
</div>
