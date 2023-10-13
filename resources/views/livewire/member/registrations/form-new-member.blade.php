<div>
    @push('customCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/src/stepper/bsStepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/scrollspyNav.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/src/plugins/css/light/stepper/custom-bsStepper.css') }}">
    @endpush
    {{-- The best athlete wants his opponent at his best. --}}

    <x-items.breadcrumb>
        <x-slot name="mainPage">Beranda</x-slot>
        <x-slot name="currentPage">Pendaftaran New Member</x-slot>
    </x-items.breadcrumb>

    <div class="row layout-top-spacing">
        <div class="d-flex align-items-center justify-content-center">
            <h1>Formulir Di Bawah Ini</h1>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="card mx-auto">
                    <div class="card-header">
                        <h4>Akad Program</h4>
                    </div>
                    <div class="card-body">
                        <p>Sebelum anda mengisi formulir, pastikan anda telah memahami poin-poin dalam akad di bawah ini. Berikan tanda <b class="text-primary"><em>Checklist</em></b> jika anda telah memahami setiap poin dalam akad</p>
                        <form>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
