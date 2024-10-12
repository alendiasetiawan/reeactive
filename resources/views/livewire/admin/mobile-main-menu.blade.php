<div>
    @push('customCss')
    <link href="{{ asset('template/src/assets/css/light/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/assets/css/dark/elements/infobox.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('admin::dashboard') }}">Main Menu</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-12">
            <div class="list-group">
                <a href="{{ route('admin::dashboard') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Dashboard
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::payment_verification') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Cek Pembayaran
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::database_member') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Database Member
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::registration_quota') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Kelas
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::request_reset_password') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Request Reset Password
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::request_class') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Request Kelas
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::registered_by_referral') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Claim Referral Code
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
                <a wire:navigate href="{{ route('admin::merchandise_voucher_verification') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    Verifikasi Voucher Merchandise
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>
                </a>
            </div>
        </div>
    </div>
</div>
