<div class="widget widget-card-five">
    <div class="widget-content">
        <div class="account-box">
            <div class="info-box">
                <div class="icon">
                    <span>
                        {{ $image }}
                        {{-- <img src="../src/assets/img/money-bag.png" alt="money-bag"> --}}
                    </span>
                </div>

                <div class="balance-info">
                    <h6>{{ $title }}</h6>
                    <p>
                        {{ $subTitle }}
                    </p>
                    @isset($info)
                    <span>
                        {{ $info }}
                    </span>
                    @endisset
                </div>
            </div>

            <div class="card-bottom-section">
                @isset($badgeLabel)
                <div>
                    {{ $badgeLabel }}
                </div>
                @endisset
                <!--Collapse-->
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
