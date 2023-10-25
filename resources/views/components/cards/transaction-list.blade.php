<div class="transactions-list">
    <div class="t-item">
        <div class="t-company-name">
            <div class="t-name">
                <h4>{{ $mainContent }}</h4>
                @isset($subContent)
                <p class="meta-date">
                    {{ $subContent }}
                </p>
                @endisset

            </div>
        </div>
        <div class="t-rate rate-dec">
            <span>
                {{ $label }}
            </span>
        </div>
    </div>
</div>
