<button {{ $attributes->merge([
    'class' => 'btn btn-dark',
    'type' => 'button' ?? ''
]) }}>
    {{ $icon }}
    <span class="btn-text-inner">
        {{ $slot }}
    </span>
</button>
