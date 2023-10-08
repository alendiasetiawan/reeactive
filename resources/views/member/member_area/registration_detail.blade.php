@extends('layouts.app')

@push('customCss')
<link href="{{ asset('template/src/assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('breadcrumb')
<x-items.breadcrumb>
    <x-slot name="mainPage" href="{{ route('member::renewal_registration') }}">Registration</x-slot>
    <x-slot name="currentPage">Detail Registrasi</x-slot>
</x-items.breadcrumb>
@endsection

@section('content')
    <livewire:member.registration-detail :detail='$detail'/>
@endsection
