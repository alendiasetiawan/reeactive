<?php

use function Livewire\Volt\{state, layout, title, updated, mount, boot, rules};
use App\Models\Member;
use App\Models\PhoneCode;

title('Reset Password');
layout('layouts.blank');

updated([
    'phone' => function() {
        $this->validate();
    }
]
);

mount(function() {
    $this->phoneCodes = PhoneCode::all();
});

boot(function() {
    $this->validate();
});

//Action to check phone number
$checkPhone = function() {
    //combine phone code and phone
    $this->phoneNumber = $this->countryPhoneCode.$this->phone;

    //Check if phone number exist
    $this->findMember = Member::where('mobile_phone', $this->phoneNumber)->count();
}

?>

<div>
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">
                        <span class="text-secondary">Home</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
            </ol>
        </nav>
    </div>

    <!--FORM REQUEST RESET-->
    <div class="row layout-top-spacing">
        <div class="d-flex align-items-center justify-content-center mt-3">
            <div class="col-lg-4 col-12">
                <div class="card mx-auto">
                    <div class="card-header">
                        Form Request Reset Password
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <p>
                                    Silahkan tulis <strong class="text-primary">"Nomor Handphone"</strong> yang terdaftar di sistem kami!
                                </p>
                            </div>
                            <div class="col-12 mb-1">
                                <div class="input-group mb-3">
                                    <x-inputs.select wire:model='countryPhoneCode'>
                                        <x-inputs.select-option value="">Kode Negara...</x-inputs.select-option>
                                        @foreach ($phoneCodes as $code)
                                        <x-inputs.select-option value="{{ $code->code }}">+{{ $code->code }} ({{ $code->country_name }})</x-inputs.select-option>
                                        @endforeach
                                    </x-inputs.select>
                                    <x-inputs.basic type="number" step="any" wire:model.live.debounce.250ms='phone' placeholder="85763827382" required
                                    oninvalid="this.setCustomValidity('Anda harus mencantumkan nomor whatsapp')"
                                    oninput="this.setCustomValidity('')"/>
                                </div>
                            </div>
                            @if ($findMember >= 1)
                            <div class="col-12 mb-1">
                                    Selamat! Kami telah menemukan data yang anda cari. Berikut detailnya :
                                    <br/>
                                    Nama :
                            </div>
                            @endif
                            <div class="col-12 mb-1 text-center">
                                @if ($errors->any())
                                    <x-buttons.solid-dark disabled type="button">Cek Data</x-buttons.solid-dark>
                                @else
                                    <x-buttons.solid-primary wire:click='checkPhone'>Cek Data</x-buttons.solid-primary>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--#FORM REQUEST RESET-->
</div>
