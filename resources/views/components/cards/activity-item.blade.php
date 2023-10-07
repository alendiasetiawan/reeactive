<div class="item-timeline timeline-new">
    @isset($icon)
        <div class="t-dot">
            <!--Class : "t-primary"-->
            <div {{ $icon->attributes->class(['']) }}>
                {{ $icon }}
            </div>
        </div>
    @endisset

    <div class="t-content">
        <div class="d-flex justify-content-between">
            <div>
                <div class="t-uppercontent">
                    <h5>{{ $mainActivity }}</h5>
                </div>
                <p>{{ $time }}</p>
            </div>
            @isset($label)
            <div class="t-rate rate-dec">
                <p><span>{{ $label }}</span></p>
            </div>
            @endisset
        </div>
    </div>
</div>
