<div>
    @push('customCss')
        <link rel="stylesheet" href="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
        <link href="{{ asset('template/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    <x-items.breadcrumb>
        <x-slot name="mainPage">Dashboard</x-slot>
        <x-slot name="currentPage">Password</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-lg-8 col-12">
            <div class="widget widget-content-area">
                <div class="widget-heading">
                    <h5>Ganti Password Akun</h5>
                </div>
                <div class="widget-content">
                    <form wire:submit.prevent="savePassword">
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Password Baru</x-inputs.label>
                                <x-inputs.basic type="password" wire:model.blur="newPassword"/>
                                @error('newPassword') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Ketik Ulang Password Baru</x-inputs.label>
                                <x-inputs.basic type="password" wire:model.live="retypeNewPassword"/>
                                @if ($passNotSame)
                                    <small class="text-danger">Password tidak sama</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                @if ($passNotSame)
                                    <x-buttons.solid-primary disabled>Simpan</x-buttons.solid-primary>
                                @else
                                    <x-buttons.solid-primary type="submit">Simpan</x-buttons.solid-primary>
                                @endif
                                <a wire:navigate href="{{ route('member::dashboard') }}">
                                    <x-buttons.outline-dark>Kembali</x-buttons.outline-dark>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('password-success', (event) => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ok! Password anda berhasil diganti',
                    showConfirmButton: false,
                    timer: 1500
                })
           });
        });
    </script>
    @endpush
</div>
