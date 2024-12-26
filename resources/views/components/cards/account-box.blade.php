<div class="widget widget-card-five" style="max-height: 250px">
    <div class="widget-content">
        <div class="account-box">
            <div class="info-box">
                @isset($image)
                <div {{ $image->attributes->merge(['class' => 'icon']) }}>
                    <span>
                        {{ $image }}
                        {{-- <img src="../src/assets/img/money-bag.png" alt="money-bag"> --}}
                    </span>
                </div>
                @endisset
                <div class="balance-info">
                    <h6>{{ $title }}</h6>
                    @isset($subTitle)
                    <p style="font-size: 12px" class="mb-2">
                        {{ $subTitle }}
                    </p>
                    @endisset

                    @isset($info)
                    <div class="mt-2">
                        <span>
                            {{ $info }}
                        </span>
                    </div>
                    @endisset
                    @isset($moreInfo)
                    <br>
                    <div class="mt-2">
                        <span>
                            {{ $moreInfo }}
                        </span>
                    </div>
                    @endisset
                </div>
            </div>

            <div class="card-bottom-section">
                @isset($badgeLabel)
                <div>
                    {{ $badgeLabel }}
                </div>
                @endisset
                {{ $slot }}
            </div>

            @isset($action)
                {{ $action }}
            @endisset
        </div>
    </div>
</div>
