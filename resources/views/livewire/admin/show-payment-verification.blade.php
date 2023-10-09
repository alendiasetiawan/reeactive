<div>
    <x-items.breadcrumb>
        <x-slot name="mainPage" href="{{ route('member::renewal_registration') }}">Verifikasi</x-slot>
        <x-slot name="currentPage">Detail Pembayaran</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <!--Verification Form-->
        <div class="col-lg-8 col-12">
            <div class="widget">
                <div class="w-header layout-spacing">
                    <h5>Detail Pembayaran Member</h5>
                </div>
                <div class="w-content">
                    <form wire:submit.prevent="saveData">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <x-inputs.label>Batch</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $paymentDetail->batch_name}}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <x-inputs.label>Nama Lengkap</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $paymentDetail->member_name }}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <x-inputs.label>Jenis Registratsi</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $paymentDetail->registration_category }}"></x-inputs.disable-text>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-12 mb-3">
                                <x-inputs.label>Program</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $paymentDetail->program_name }}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-4 col-12 mb-3">
                                <x-inputs.label>Coach</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $paymentDetail->coach_name }}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-4 col-12 mb-3">
                                <x-inputs.label>Kelas</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ \Carbon\Carbon::parse($paymentDetail->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($paymentDetail->end_time)->format('H:i') }}"></x-inputs.disable-text>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Nominal Transfer</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ 'Rp '.number_format($paymentDetail->amount_pay,0,',','.') }}"></x-inputs.disable-text>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Waktu Upload</x-inputs.label>
                                <x-inputs.disable-text placeholder="{{ $paymentDetail->created_at->isoFormat('LLLL') }}"></x-inputs.disable-text>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Status Transfer</x-inputs.label>
                                <x-inputs.select wire:model.live="paymentStatus" required
                                oninvalid="this.setCustomValidity('Apakah bukti transfer nya valid?')"
                                oninput="this.setCustomValidity('')">
                                    <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                                    <x-inputs.select-option value="Done">Valid</x-inputs.select-option>
                                    <x-inputs.select-option value="Invalid">Tidak Valid</x-inputs.select-option>
                                </x-inputs.select>
                            </div>
                            @if ($showReasonInvalid == true)
                            <div class="col-lg-6 col-12 mb-3">
                                <x-inputs.label>Alasan Invalid</x-inputs.label>
                                <textarea class="form-control" wire:model="invalidReason" rows="3" required
                                oninvalid="this.setCustomValidity('Alasan invalid wajib diisi')"
                                oninput="this.setCustomValidity('')"></textarea>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <x-buttons.solid-primary type="submit">Simpan</x-buttons.solid-primary>
                                <a wire:navigate href="{{ route('admin::payment_verification') }}">
                                    <x-buttons.outline-dark>Kembali</x-buttons.outline-dark>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--#Verfiication Form-->

        <div class="col-lg-4 col-12">
            <div class="widget">
                <div class="w-header layout-spacing">
                    <h5>Lampiran Bukti Transfer</h5>
                </div>
                <div class="w-conten">
                    <img src="{{ asset('storage/'.$paymentDetail->file_upload) }}" width="100%" height="auto">
                </div>
            </div>
        </div>
    </div>

    @push('customScripts')
    <script src="{{ asset('template/src/plugins/src/table/datatable/datatables.js') }}" data-navigate-once></script>
    <script data-navigate-once>
        document.addEventListener('livewire:navigating', () => {

            $('#paymentsTable').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 10
            });
        })
    </script>
    @endpush
</div>
