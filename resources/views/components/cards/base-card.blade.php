@props(['cardBody', 'cardHeader', 'subHeader'])

<div {{ $attributes->merge(['class' => 'card']) }}>
    @isset($cardHeader)
    <div {{ $cardHeader->attributes->class(['card-header']) }}>
        <h3 class="card-title mb-50">{{ $cardHeader }}</h3>
        @isset($subHeader)
        <div {{ $subHeader->attributes->class(['d-flex align-items-center']) }}>
            {{ $subHeader }}
        </div>
        @endisset
    </div>
    @endisset

    @isset($cardBody)
    <div {{ $cardBody->attributes->class(['card-body']) }}>
        {{ $cardBody }}
    </div>
    @endisset
    {{ $slot }}
</div>
