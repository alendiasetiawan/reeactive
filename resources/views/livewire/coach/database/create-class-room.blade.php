<div>
    @push('customCss')
    <link href="{{ asset('template/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    @endpush

    <x-items.breadcrumb>
        <x-slot name="mainPage" wire:navigate href="{{ route('coach::class_room') }}">Kelas</x-slot>
        <x-slot name="currentPage">Tambah Kelas</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="col-lg-6 col-12">
            <div class="widget">
                <div class="widget-header">
                    <h5>Form Request Buka Kelas Baru</h5>
                </div>
                <div class="widget-content mt-3">
                    <span><em>Silahkan isi form di bawah ini untuk mengajukan pembukaan kelas baru, apabila disetujui anda akan mendapatkan konfirmasi</em></span>
                    <form wire:submit='sendRequest'>
                        <div class="row mt-2">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Program</x-inputs.label>
                                <x-inputs.basic wire:model='programName' disabled/>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Hari</x-inputs.label>
                                <x-inputs.basic placeholder="Contoh : Senin, Rabu, Jum'at" wire:model='day' required
                                oninvalid="this.setCustomValidity('Tulis hari nya ya!')"
                                oninput="this.setCustomValidity('')"/>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Waktu Mulai</x-inputs.label>
                                <x-inputs.time-pickr wire:model='startTime' required
                                oninvalid="this.setCustomValidity('Dari jam berapa?')"
                                oninput="this.setCustomValidity('')"/>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Waktu Selesai</x-inputs.label>
                                <x-inputs.time-pickr wire:model='endTime' id="timeFlatpickrDua" required
                                oninvalid="this.setCustomValidity('Sampai jam berapa?')"
                                oninput="this.setCustomValidity('')"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <x-buttons.solid-primary>Kirim</x-buttons.solid-primary>
                                <a wire:navigate href="{{ route('coach::class_room') }}">
                                    <x-buttons.outline-dark type="button">Batal</x-buttons.outline-dark>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('template/src/plugins/src/flatpickr/flatpickr.main.js') }}" data-navigate-once></script>

    <script>
        document.addEventListener('livewire:navigated', () => {
        var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:s",
            defaultDate: "",
        });
    });
    </script>

    <script>
        document.addEventListener('livewire:navigated', () => {
        var f4 = flatpickr(document.getElementById('timeFlatpickrDua'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i:s",
            defaultDate: "",
        });
    });
    </script>
    @endpush
</div>
