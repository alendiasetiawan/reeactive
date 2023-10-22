<div class="widget widget-card-five">
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
                    <p style="font-size: 12px">
                        {{ $subTitle }}
                    </p>
                    @isset($info)
                    <span>
                        {{ $info }}
                    </span>
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
                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#detailProgram">Detail Program</a> --}}
            </div>
        </div>
    </div>
</div>
