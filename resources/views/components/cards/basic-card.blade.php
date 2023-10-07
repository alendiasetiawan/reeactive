<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $cardTitle }}</h5>
        @isset($cardLabel)
            <small class="text-muted float-end">
                {{ $cardLabel }}
            </small>
        @endisset
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
