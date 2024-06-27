<div {{ $attributes->merge(['class' => 'card style-4']) }}>
    <div class="card-body pt-3">
        <div class="media mt-0 mb-3">
            @isset($userImage)
                <div class="avatar avatar-md me-3">
                    {{ $userImage }}
                </div>
            @endisset
            <div class="media-body">
                <h4 class="mb-0">{{ $userName }}</h4>
                <span class="text-muted">{{ $userTitle }}</span>
            </div>
            @isset($icon)
                <div>
                    <a
                    {{ $icon->attributes->merge([
                        'href' => '#' ?? '',
                        'class' => 'text-muted' ?? ''
                    ])}}>
                        {{ $icon }}
                    </a>
                </div>
            @endisset

        </div>
        <span class="card-text mt-4 mb-0">
            {{ $slot }}
        </span>
    </div>
    @isset($bottomButton)
    <div class="card-footer pt-0 mb-2 border-0 text-center">
        @isset($loading)
            {{ $loading }}
        @endisset
        <a {{ $bottomButton->attributes->class(['btn btn-secondary w-100'])->merge(['href' => '']) }}>
            {{ $bottomButton }}
        </a>
    </div>
    @endisset

</div>
