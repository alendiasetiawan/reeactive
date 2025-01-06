<div>
    @push('vendorCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/vendors/css/extensions/toastr.min.css') }}">
    @endpush

    @push('pageCss')
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/forms/pickers/form-pickadate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('style/app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    @endpush

    <x-vuexy.links.breadcrumb>
        <x-slot:title>Pengaturan Akun</x-slot:title>
        <x-slot:activePage>Pengaturan Akun</x-slot:activePage>
    </x-vuexy.links.breadcrumb>

    <div class="row">
        <div class="col-lg-7 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Ubah Password</x-slot:cardTitle>
                <form wire:submit="savePassword">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-1">
                            <x-inputs.label>Password Baru</x-inputs.label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password" wire:model.live="newPassword"/>
                                <span class="input-group-text cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </span>
                            </div>
                            @error('newPassword') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-lg-6 col-12 mb-1">
                            <x-inputs.label>Ulangi Password Baru</x-inputs.label>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password" wire:model.live="retypeNewPassword"/>
                                <span class="input-group-text cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </span>
                            </div>
                            @error('retypeNewPassword') <small class="text-danger">{{ $message }}</small> @enderror
                            @if ($passNotSame)
                                <small class="text-danger">Password tidak sama</small>
                            @endif
                        </div>

                        <div class="col-lg-6 col-12">
                            @if ($passNotSame)
                                <x-buttons.basic color="primary" disabled>Simpan</x-buttons.basic>
                            @else
                                <x-buttons.basic color="primary" type="submit">
                                    Simpan
                                </x-buttons.basic>
                            @endif
                            <a href="/login">
                                <x-buttons.outline-dark type="button">Kembali</x-buttons.outline-dark>
                            </a>
                        </div>
                    </div>
                </form>
            </x-cards.basic-card>
        </div>
    </div>

    @push('vendorScripts')
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('style/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @endpush

    @push('pageScripts')
        <script src="{{ asset('style/app-assets/js/scripts/pages/auth-login.js') }}"></script>
        <script src="{{ asset('style/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
        <script src="{{ asset('style/app-assets/js/scripts/extensions/ext-component-toastr.js') }}"></script>
    @endpush
</div>
