@extends('layouts.app')

@push('customCss')
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('template/src/assets/css/dark/elements/alert.css') }}">
@endpush

@section('content')
<div class="row layout-top-spacing">
    <div class="col-12">
        <div class="alert alert-arrow-right alert-icon-right alert-light-info alert-dismissible fade show mb-4" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
            <strong>Ayo Kuat Untuk Taat!</strong> Halaman Dashboard Member
        </div>
    </div>
</div>
@endsection
