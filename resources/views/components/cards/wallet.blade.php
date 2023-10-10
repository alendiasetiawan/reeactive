<div class="widget widget-wallet-one">
    <div class="wallet-info text-center mb-3">

        <p class="wallet-title mb-3">
            {{ $header }}
        </p>

        <p class="total-amount mb-3">
            {{ $mainTitle }}
        </p>

        <span href="#" class="wallet-text">
            {{ $info }}
        </span>

    </div>

    <div class="wallet-action text-center d-flex justify-content-around">

        @isset($buttonActionOne)
            {{ $buttonActionOne }}
        @endisset

        @isset($buttonActionTwo)
            {{ $buttonActionTwo }}
        @endisset

    </div>

    <hr>

    <ul class="list-group list-group-media">
        {{ $slot }}
    </ul>

    @isset($callToAction)
        {{ $callToAction }}
    @endisset
</div>
