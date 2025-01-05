<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Verifikasi Transfer</x-slot:title>
        <x-slot:activePage>Verifikasi Transfer</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <!--Filter Data-->
    <div class="row">
        <div class="col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Program Reguler <b class="text-primary">{{ $batchName }}</b></x-slot:cardTitle>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Cari Member</x-inputs.label>
                        <x-inputs.vuexy-basic placeholder="Ketik nama member..." wire:model.live.debounce.250ms='searchMember'/>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-1">
                        <x-inputs.label>Status Transfer</x-inputs.label>
                        <x-inputs.vuexy-select wire:model.live='transferStatus'>
                            <x-inputs.vuexy-select-option value="">Semua</x-inputs.vuexy-select-option>
                            <x-inputs.vuexy-select-option value="Process">Proses</x-inputs.vuexy-select-option>
                            <x-inputs.vuexy-select-option value="Done">Valid</x-inputs.vuexy-select-option>
                            <x-inputs.vuexy-select-option value="Invalid">Tidak Valid</x-inputs.vuexy-select-option>
                        </x-inputs.vuexy-select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <x-badges.basic color="warning" class="me-25">Proses : {{ $totalPaymentProcess }}</x-badges.basic>
                        <x-badges.basic color="success" class="me-25">Valid : {{ $totalPaymentDone }}</x-badges.basic>
                        <x-badges.basic color="danger" class="me-25">Invalid : {{ $totalPaymentInvalid }}</x-badges.basic>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
    </div>
    <!--Filter Data-->

    <!--List of Registration Member-->
    <div class="row
    @if($this->payments->count() > 3 && !$isTablet)
        scroller3
    @endif">
        <!--Loading Indicator-->
        <x-items.loading-dots class="mb-1" wire:loading wire:target='searchMember'/>
        <x-items.loading-dots class="mb-1" wire:loading wire:target='transferStatus'/>
        <!--Loading Indicator-->
        @forelse ($this->payments as $payment)
            <div class="col-lg-4 col-md-6 col-12">
                <a href="{{ route('admin::payment_verification.show', $payment->id) }}" class="text-dark" wire:navigate>
                    <x-cards.role-card wire:key='{{ $payment->id }}'>
                        <x-slot:title>Coach {{ $payment->nick_name }} - {{ $payment->program_name }}</x-slot:title>
                        <x-slot:subTitle>
                            <x-badges.basic :color="$payment->payment_status == 'Done' ? 'success' : ($payment->payment_status == 'Process' ? 'warning' : 'danger')">
                                {{ $payment->payment_status }}
                            </x-badges.basic>
                        </x-slot:subTitle>
                        <x-slot:content>{{ $payment->member_name }}</x-slot:content>
                        <x-slot:subContent>
                            <span class="text-muted">
                                {{ $payment->day }} ({{ \Carbon\Carbon::parse($payment->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($payment->end_time)->format('H:i') }})
                                <br/>
                                {{ 'Rp '.number_format($payment->amount_pay,0,',','.') }}
                            </span>
                        </x-slot:subContent>
                        <x-items.wa-icon width="25" height="25" href="https://wa.me/{{ $payment->mobile_phone }}"/>
                    </x-cards.role-card>
                </a>
            </div>
        @empty
            <div class="col-12">
                <x-alerts.not-found />
            </div>
        @endforelse

        @if ($this->payments->hasMorePages())
            <div class="col-12 text-center">
                <x-buttons.outline-primary wire:click='loadMore'>Tampilkan Lagi</x-buttons.outline-primary>
                <x-items.loading-dots wire:loading wire:target='loadMore'/>
            </div>
        @endif
    </div>
    <!--#List of Registration Member-->

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
        <script data-navigate-once>
            window.addEventListener('payment-verification-success', function () {
                'use strict';
                var isRtl = $('html').attr('data-textdirection') === 'rtl';

                // On load Toast
                setTimeout(function () {
                    toastr['success'](
                    '👋Verifikasi transfer berhasil',
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
