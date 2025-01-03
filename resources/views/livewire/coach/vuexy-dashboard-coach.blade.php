<div>
    <div class="row match-height">
        <!--Member Reguler Program-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.developer-meetup>
                <x-slot:avatar>
                    <img src="{{ asset('style/app-assets/images/banner/program-reguler.png') }}" alt="avatar" class="img-fluid">
                </x-slot:avatar>
                <x-slot:month>Batch</x-slot:month>
                <x-slot:date>{{ $batchNumber }}</x-slot:date>
                <x-slot:title>{{ $activeMember }} Member Aktif</x-slot:title>
                <x-slot:subTitle>Coach {{ Auth::user()->full_name }}</x-slot:subTitle>
                <div class="small-scroller">
                    @foreach ($membersInClass as $member)
                        <x-cards.developer-meeting-item>
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock font-medium-3"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            </x-slot:icon>
                            <x-slot:title>{{ $member->day }}</x-slot:title>
                            <x-slot:subTitle>
                                {{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }}
                            </x-slot:subTitle>
                            <x-slot:actionButton>
                                <x-badges.light-badge color="primary">{{ $member->registrations->count() }} Member</x-badges.light-badge>
                            </x-slot:actionButton>
                        </x-cards.developer-meeting-item>
                    @endforeach
                </div>
                <x-slot:actionButton>
                    <a wire:navigate href="{{ route('coach::active_members') }}">
                        <x-buttons.basic color="primary" class="w-100">Selengkapnya</x-buttons.basic>
                    </a>
                </x-slot:actionButton>
            </x-cards.developer-meetup>
        </div>
        <!--#Member Reguler Program-->

        <!--Member Kelas Lepasan-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.developer-meetup>
                <x-slot:avatar>
                    <img src="{{ asset('style/app-assets/images/banner/kelas-lepasan.png') }}" alt="avatar" class="img-fluid">
                </x-slot:avatar>
                <x-slot:month>{{ \Carbon\Carbon::parse(now())->isoFormat('MMM') }}</x-slot:month>
                <x-slot:date>{{ date('d') }}</x-slot:date>
                <x-slot:title>Total Peserta : {{ $activeMemberOpenClass }}</x-slot:title>
                <x-slot:subTitle>Coach {{ Auth::user()->full_name }}</x-slot:subTitle>
                @if ($membersOpenClass->count() != 0)
                    <div class="small-scroller">
                        @foreach ($membersOpenClass as $member)
                            <x-cards.developer-meeting-item>
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock font-medium-3"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </x-slot:icon>
                                <x-slot:title>{{ \App\Helpers\TanggalHelper::convertImplodeDay($member->day) }}</x-slot:title>
                                <x-slot:subTitle>
                                    {{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }}
                                </x-slot:subTitle>
                                <x-slot:actionButton>
                                    <x-badges.light-badge color="primary">{{ $member->specialRegistrations->count() }} Member</x-badges.light-badge>
                                </x-slot:actionButton>
                            </x-cards.developer-meeting-item>
                        @endforeach
                    </div>
                @else
                <div class="row">
                    <div class="col-12">
                        <x-alerts.main-alert color="danger">
                            Anda belum memiliki peserta di Kelas Lepasan
                        </x-alerts.main-alert>
                    </div>
                </div>
                @endif

                <x-slot:actionButton>
                    <a wire:navigate href="{{ route('coach::open_class_member') }}">
                        <x-buttons.basic color="primary" class="w-100">Selengkapnya</x-buttons.basic>
                    </a>
                </x-slot:actionButton>
            </x-cards.developer-meetup>
        </div>
        <!--#Member Kelas Lepasan-->

        <!--Status Class-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.employee>
                <x-slot:header>Status Kelas</x-slot:header>
                <x-slot:option>
                    <a href="{{ route('coach::class_room') }}">
                        <x-buttons.basic color="primary" class="btn-icon btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </x-buttons.basic>
                    </a>
                </x-slot:option>
                @forelse ($classLargeGroup as $class)
                    <x-cards.employee-task wire:key='{{ $class->id }}'>
                        <x-slot:title>{{ $class->day }}</x-slot:title>
                        <x-slot:subTitle>
                            {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                            @if ($class->link_wa != null)
                                <x-items.wa-icon href="{{ $class->link_wa }}" />
                            @endif
                        </x-slot:subTitle>
                        <x-slot:label>
                            <span class="{{ $class->class_status_eksternal == 'Open' ? 'text-success' : 'text-danger' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status New Member">{{ $class->class_status_eksternal }}</span>
                            |
                            <span class="{{ $class->class_status == 'Open' ? 'text-success' : 'text-danger' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Status Renewal">{{ $class->class_status }}</span>
                        </x-slot:label>
                    </x-cards.employee-task>
                @empty
                    <div class="row">
                        <div class="col-12">
                            <x-alerts.main-alert color="danger">Belum ada kelas yang bisa ditampilkan</x-alerts.main-alert>
                        </div>
                    </div>
                @endforelse
            </x-cards.employee>
        </div>
        <!--#Status Class-->

        <!--Edit Class Modal-->
        <livewire:components.modals.coach.class-edit-modal modalId='editClassModal' :$classId/>
        <!--#Edit Class Modal-->
    </div>
</div>
