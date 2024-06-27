<div>
    @use('App\Helpers\TanggalHelper')

    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::dashboard') }}">Dashboard</x-slot>
        <x-slot name="currentPage">Request Reset Password</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-lg-5 col-12 mb-1">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.basic placeholder="Ketik nama disini..." wire:model.live.debounce.250ms='searchMember'/>
        </div>
    </div>

    <div class="row mt-2">
        @forelse ($this->requestMembers as $member)
            <div class="col-lg-4 col-md-6 col-12 mb-2">
                <x-cards.user>
                    <x-slot:userName>{{ $member->member_name }}</x-slot:userName>
                    <x-slot:userTitle>{{ TanggalHelper::konversiTanggalPenuh($member->created_at) }}</x-slot:userTitle>
                    Program: {{ $member->program }} <br/>
                    Coach : {{ $member->coach }} <br/>
                    Kelas : {{ $member->class }} <br/>
                    Whatsapp : {{ $member->whatsapp }} <br/> <br/>
                    @if ($member->notif == 1)
                    <x-items.badges.light-success>
                        Notifikasi: Sudah
                    </x-items.badges.light-success>
                    @else
                    <x-items.badges.light-danger>
                        Notifikasi: Belum
                    </x-items.badges.light-danger>
                    @endif
                    <x-slot:bottomButton href="#" wire:click='sendLink({{ $member->id }})' wire:loading.remove='sendLink'>
                        Kirim Link
                    </x-slot:bottomButton>
                    <x-slot:loading>
                        <div class="spinner-grow text-primary align-self-center" wire:loading wire:target='sendLink'></div>
                    </x-slot:loading>
                </x-cards.user>
            </div>
        @empty
            <div class="col-12">
                <x-items.alerts.light-danger>Upss.. tidak ada data yang bisa ditampilkan</x-items.alerts.light-danger>
            </div>
        @endforelse

        @if ($this->requestMembers->hasMorePages())
            <div class="col-12 text-center mt-3">
                <x-buttons.outline-primary wire:click='loadMore'>
                    Tampilkan Lagi
                </x-buttons.outline-primary>
            </div>
        @endif
    </div>

    <script data-navigate-once>
        document.addEventListener('sending-link', function(event) {
            var url = event.detail.url;

            setTimeout( () => {
                window.open(url,"_blank");
            }, 500);
        });
    </script>
</div>
