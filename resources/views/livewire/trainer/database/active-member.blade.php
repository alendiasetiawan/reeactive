<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('trainer::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Database Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <h4>Data Member Aktif</h4>
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.basic type="text" placeholder="Ketik nama disini..." wire:model.live="searchMember"/>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-2">
            <x-inputs.label>Filter Program</x-inputs.label>
            <x-inputs.select wire:model.live='filterProgram'>
                <x-inputs.select-option value="0">--Semua--</x-inputs.select-option>
                @forelse ($programList as $program)
                <x-inputs.select-option value="{{ $program->id }}">{{ $program->program_name }}
                </x-inputs.select-option>
                @empty
                <x-inputs.select-option>Tidak ada data kelas</x-inputs.select-option>
                @endforelse
            </x-inputs.select>
        </div>
        <div class="mb-3">

        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <button type="button" class="btn btn-info">
                Jumlah Member <span class="badge bg-light text-dark ms-2">
                    @if ($filterProgram == 0)
                        {{ $activeMember }}
                    @else
                    {{ $activeMemberInProgram }}
                    @endif
                </span>
            </button>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($this->members as $member)
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <x-cards.user>
                    <x-slot name="userImage">
                        <x-cards.user-image src="{{ asset('template/src/assets/img/avatar/user_akhwat.png') }}"></x-cards.user-image>
                    </x-slot>
                    <x-slot name="userName">{{ $member->member_name }}</x-slot>
                    <x-slot name="userTitle">
                        @if ($member->program_name == 'Early Postpartum Workshop' )
                            <b class="text-success">{{ $member->program_name }}</b>
                        @else
                            <b class="text-secondary">{{ $member->program_name }}</b>
                        @endif
                    </x-slot>
                    <x-slot name="icon" href="https://wa.me/{{ $member->mobile_phone }}" target="_blank">
                        <i class="fa-brands fa-whatsapp fa-xl" style="color: #19c502;"></i>
                    </x-slot>
                    <ul class="mb-0">
                        <li>
                            @if ($member->is_assessment == 1)
                                Assessment : <b class="text-info">Sudah</b>
                            @else
                                Assessment : <b class="text-danger">Belum</b>
                            @endif
                        </li>
                        <li>{{ $member->day }} ({{ \Carbon\Carbon::parse($member->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($member->end_time)->format('H:i') }})</li>
                        @if ($member->voucher_code != null)
                        <li>
                            Kode Voucher : <b><em>{{ $member->voucher_code }}</em></b>
                        </li>
                        @endif
                    </ul>
                    {{-- <x-slot name="bottomButton" href="#">Detail Member</x-slot> --}}
                </x-cards.user>
            </div>
        @endforeach
        {{ $this->members->links() }}
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/custom.js') }}"></script>
    @endpush
</div>
