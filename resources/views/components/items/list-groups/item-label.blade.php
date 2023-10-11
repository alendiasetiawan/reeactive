<div class="list-group-item d-flex justify-content-between align-items-start">
    @isset($image)
        {{ $image }}
        {{-- <img src="../src/assets/img/card-americanexpress.svg" class="align-self-center me-3" alt="americanexpress"> --}}
    @endisset

    <div class="me-auto">
        <div class="fw-bold title">{{ $title }}</div>
        <p class="sub-title mb-0">{{ $subTitle }}</p>
    </div>
    {{ $slot }}
</div>
