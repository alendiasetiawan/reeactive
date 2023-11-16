<li class="list-group-item">
    <div class="media">
        @isset($image)
            <div class="me-3">
                <img {{ $attributes->class(['img-fluid rounded-circle'])->merge(['src' => '', 'alt' => 'avatar']) }}>
            </div>
        @endisset
        <div class="media-body">
            <h6 class="tx-inverse">{{ $title }}</h6>
            @isset($subTitle)
            <p class="mg-b-0">{{ $subTitle }}</p>
            @endisset

            <p class="amount">{{ $info }}</p>
        </div>
    </div>
</li>
