<div class="widget widget-table-one">
    <div class="widget-heading">
        <h5
        {{ $cardTitle->attributes->merge([
            'class' => 'text-primary' ?? ''
        ])}}
        >
            {{ $cardTitle }}
        </h5>
    </div>
    <div class="widget-content">
        {{ $slot }}
    </div>
</div>
