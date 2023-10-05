@extends('layouts.master')

@section('breadcrumb')
<h4 class="fw-bold py-2 mb-3">
    <span class="text-muted fw-light">Registrasi /</span> Renewal Member
</h4>
@endsection

@section('content')
    <livewire:member.renewal-form />
@endsection
