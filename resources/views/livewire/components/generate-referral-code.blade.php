<div>
    <div class="widget widget-five" style="max-height: 235px">
        <div class="widget-heading">
            <a href="javascript:void(0)" class="task-info">
                <div class="usr-avatar">
                    <span>PR</span>
                </div>
                <div class="w-title">
                    <h5>Program Referral</h5>
                    <small class="text-muted">
                        {{ $isCodeGenerated ? 'Aktif' : 'Belum Daftar' }}
                    </small>
                </div>
            </a>
        </div>

        <div class="widget-content">
            <p class="mt-1">
                @if ($isCodeGenerated)
                    Ayo ajak teman kamu gabung ke reeactive sekarang juga!
                @else
                    Ayo buat kode referral kamu, bagikan kepada teman dan dapatkan keuntungan nya!
                @endif
            </p>
            <div class="progress-data">
                <div class="progress-info">
                    <div class="task-count">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <p>{{ $registeredByReferral }} Member</p>
                    </div>
                    @if ($isCodeGenerated)
                        <div class="progress-stats" x-data="{ showMsg: false }">
                            <div x-data="{ input: '{{ $referral->code }}', showMsg: false }" >
                                <span class="text-primary">Kode : {{ $referral->code }}</span>
                                <a href="javascript:void(0)" @click="navigator.clipboard.writeText(input), showMsg = true, setTimeout(() => showMsg = false, 1000)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy text-primary"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                                </a>
                                <div x-show="showMsg" @click.away="showMsg = false" style="display: none;">
                                    Kode Disalin!
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="#" class="text-primary" wire:click='generateCode'>
                            Buat Kode
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a>
                    @endif
                </div>
            </div>

            <div class="mt-2">
                <a wire:navigate href="{{ route('member::referral_member') }}">
                    <x-buttons.solid-primary class="w-100">Detail</x-buttons.solid-primary>
                </a>
            </div>
        </div>
    </div>
</div>
