<div {{ $attributes->merge(['class' => 'card card-congratulation-medal']) }}>
    <div class="card-body">
        <h5>{{ $title }}</h5>
        @isset($subTitle)
            <p class="card-text font-small-3">
                {{ $subTitle }}
            </p>
        @endisset
        <h3 class="mb-75 mt-3 pt-50">
            <a href="#">{{ $content }}</a>
        </h3>
        {{ $actionButton }}
        @isset($image)
            {{ $image }}
        @endisset
        {{-- <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" /> --}}
    </div>
</div>
