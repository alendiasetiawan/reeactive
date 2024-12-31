<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">{{ $cardTitle }}</h4>
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
