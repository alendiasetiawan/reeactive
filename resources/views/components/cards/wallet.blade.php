<div class="widget widget-wallet-one">
    <div class="wallet-info text-center mb-3">

        <p class="wallet-title mb-3">
            {{ $header }}
        </p>

        @isset($mainTitle)
        <p class="total-amount mb-3">
            {{ $mainTitle }}
        </p>
        @endisset

        @isset($info)
        <span href="#" class="wallet-text">
            {{ $info }}
        </span>
        @endisset

    </div>

    <div class="wallet-action text-center d-flex justify-content-around">

        @isset($buttonActionOne)
            {{ $buttonActionOne }}
        @endisset

        @isset($buttonActionTwo)
            {{ $buttonActionTwo }}
        @endisset

    </div>

    {{ $slot }}

    @isset($callToAction)
        {{ $callToAction }}
    @endisset
</div>
