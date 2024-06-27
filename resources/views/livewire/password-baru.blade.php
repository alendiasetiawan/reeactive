<div>
    <x-items.breadcrumb>
        <x-slot:mainPage href="{{ route('landing') }}">Home</x-slot:mainPage>
        <x-slot:currentPage>Password Baru</x-slot:currentPage>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="d-flex align-items-center justify-content-center mt-3">
            <div class="col-lg-4 col-12">
                <div class="card mx-auto">
                    <div class="card-header">
                        <h4>Form Reset Password</h4>
                    </div>
                    <div class="card-body">
                        @if (session('reset-error'))
                        <div class="row">
                            <div class="col-12 mb-1 text-center">
                                <b class="text-danger">{{ session('reset-error') }}</b>
                            </div>
                        </div>
                        @endif
                        @if ($isResetSuccess)
                            <div class="row">
                                <div class="col-12 mb-1 text-center">
                                    <b>{{ session('reset-success') }}</b>
                                    <br>
                                    <x-buttons.solid-primary onclick="location.href='{{ route('login') }}'">Login Sekarang</x-buttons.solid-primary>
                                </div>
                            </div>
                        @else
                            @if ($isLinkActive)
                            <form wire:submit='savePassword'>
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <p>
                                            Silahkan isi form di bawah ini untuk membuat password baru anda!
                                        </p>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <x-inputs.label>Nama Member</x-inputs.label>
                                        <x-inputs.basic wire:model='memberName' disabled/>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <x-inputs.label>Program</x-inputs.label>
                                        <x-inputs.basic  wire:model='program' disabled/>
                                    </div>
                                    <div x-data="{ show: false}">
                                        <div class="col-12 mb-1">
                                            <x-inputs.label>Password Baru</x-inputs.label>
                                            <input class="form-control form-control-sm" :type="show ? 'text' : 'password'" wire:model.live.debounce.300ms='newPassword'/>
                                            @error('newPassword')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 mb-3">
                                            <x-inputs.label>Ketik Ulang Password Baru</x-inputs.label>
                                            <input class="form-control form-control-sm" :type="show ? 'text' : 'password'" wire:model.live.debounce.300ms='retypeNewPassword'/>
                                            @if ($retypeNewPassword && !$isPasswordSame)
                                                <small class="text-danger">Password harus sama</small>
                                            @endif
                                        </div>
                                        <a href="#" @click="show = !show">
                                            <span x-show="!show">
                                                Tampilkan Password
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </span>
                                            <span x-show="show">
                                                Sembunyikan Password
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                            </span>
                                        </a>
                                    </div>

                                    <div class="col-12 mb-1 mt-2 text-center">
                                        @if ($isActiveButton && !$errors->any())
                                            <x-buttons.solid-primary>Simpan</x-buttons.solid-primary>
                                        @else
                                            <x-buttons.solid-dark type="button" disabled>Simpan</x-buttons.solid-dark>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @else
                                <div class="row">
                                    <div class="col-12 mb-1 text-center">
                                        <b class="text-danger">Mohon maaf, link tidak valid. Silahkan request ulang reset password anda
                                            <a wire:navigate href="{{ route('reset_password') }}" class="text-info">Disini</a>
                                        </b>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
