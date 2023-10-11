<div class="card style-4">
    <div class="card-body pt-3">
        <div class="media mt-0 mb-3">
            @isset($userImage)
                <div class="avatar avatar-md me-3">
                    {{ $userImage }}
                </div>
            @endisset
            <div class="media-body">
                <h4 class="media-heading mb-0">{{ $userName }}</h4>
                <p class="media-text">{{ $userTitle }}</p>
            </div>
        </div>
        <span class="card-text mt-4 mb-0">
            {{ $slot }}
        </span>
    </div>
    <div class="card-footer pt-0 border-0 text-center">
        <a {{ $attributes->class(['btn btn-secondary w-100'])->merge(['href' => '']) }}>
            {{ $bottomButton }}
        </a>
    </div>
</div>
