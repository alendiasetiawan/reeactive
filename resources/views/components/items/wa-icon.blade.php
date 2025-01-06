@props([
    'width' => '20',
    'height' => '20'
])

<a {{ $attributes->merge([
    'href' => '',
    'target' => '_blank'
]) }}>
    <img src="{{ asset('style/app-assets/images/icons/wa-icon.svg') }}" width="{{ $width }}" height="{{ $height }}" alt="whatsapp" />
</a>
