<div class="widget widget-wallet-one">
    <div class="wallet-info text-center mb-3">

        <p class="wallet-title mb-3">
            {{ $header }}
        </p>

        <p class="total-amount mb-3">
            {{ $mainTitle }}
        </p>

        <a href="#" class="wallet-text">
            {{ $info }}
        </a>

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
        <li class="list-group-item ">
            <div class="media">
                <div class="me-3">
                    <img alt="avatar" src="../src/assets/img/netflix.svg" class="img-fluid rounded-circle">
                </div>
                <div class="media-body">
                    <h6 class="tx-inverse">Netflix</h6>
                    <p class="mg-b-0">June 6, 10:34</p>
                    <p class="amount">- $18.06</p>
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="media">
                <div class="me-3">
                    <img alt="avatar" src="../src/assets/img/apple-app-store.svg" class="img-fluid rounded-circle">
                </div>
                <div class="media-body">
                    <h6 class="tx-inverse">App Design</h6>
                    <p class="mg-b-0">June 14, 05:21</p>
                    <p class="amount">- $90.65</p>
                </div>
            </div>
        </li>
    </ul>

    @isset($callToAction)
        <button class="btn btn-secondary w-100 mt-3">
            {{ $callToAction }}
        </button>
    @endisset
</div>
