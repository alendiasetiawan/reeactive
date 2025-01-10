<div>
    <x-vuexy.links.breadcrumb>
        <x-slot:title>Reset Password</x-slot:title>
        <x-slot:activePage>Reset Password</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row mb-1">
        <div class="col-lg-4 col-md-6 col-12">
            <x-inputs.label>Cari Member</x-inputs.label>
            <x-inputs.vuexy-basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
        </div>
    </div>

    <div class="row">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <!--#Loading Indicator-->

        @forelse ($this->requestMembers as $member)
            <div class="col-lg-4 col-md-6 col-12">
                <x-cards.apply-job color="primary" wire:key='{{ $member->id }}'>
                    <x-slot:avatarIcon>{{ $loop->iteration }}</x-slot:avatarIcon>
                    <x-slot:title>{{ Str::excerpt($member->member_name, '', ['radius' => $isMobile ? 20 : 25]) }}</x-slot:title>
                    <x-slot:subTitle>{{ \Carbon\Carbon::parse($member->created)->isoFormat('lll') }}</x-slot:subTitle>
                    <x-slot:label>
                        @if ($member->notif == 1)
                            <x-badges.light-badge color="success">Sudah</x-badges.light-badge>
                        @else
                            <x-badges.light-badge color="danger">Belum</x-badges.light-badge>
                        @endif
                    </x-slot:label>
                    <x-slot:headingContent>+{{ $member->whatsapp }}</x-slot:headingContent>
                    {{ $member->program }} <br/>
                    Coach {{ $member->coach }} <br/>
                    {{ $member->class }} <br/>
                    <x-slot:actionButton>
                        <x-buttons.basic color="primary" class="w-100" wire:click='sendLink({{ $member->id }})' wire:loading.remove='sendLink'>
                            Kirim Link
                        </x-buttons.basic>
                        <x-items.loading-dots wire:loading wire:target='sendLink'/>
                    </x-slot:actionButton>
                </x-cards.apply-job>
            </div>
        @empty
            <div class="col-12 text-center">
                <x-alerts.not-found />
            </div>
        @endforelse

        <div class="col-12 text-center">
            @if ($this->requestMembers->hasMorePages())
                <x-buttons.outline-primary wire:click='loadMore' wire:loading.remove='loadMore'>Tampilkan Lagi</x-buttons.outline-primary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            @endif
        </div>
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
