<div {{ $attributes->merge(['class' => 'card']) }}>
    @isset($header)
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
            @isset($subHeader)
                <div class="d-flex align-items-center">
                    {{ $subHeader }}
                </div>
            @endisset
        </div>
    @endisset
    <div class="card-body">
        @isset($action)
            {{ $action }}
        @endisset
        <div {{ $slot->attributes->merge(['class' => 'scroller4']) }}>
            <ul class="timeline">
                {{ $slot }}
            </ul>
        </div>
        @isset($actionButton)
        <div class="mt-1">
            {{ $actionButton }}
        </div>
        @endisset
    </div>
</div>
