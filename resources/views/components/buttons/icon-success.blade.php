<button {{ $attributes->merge([
    'class' => 'btn btn-success',
    'type' => 'button' ?? ''
]) }}>
    {{ $icon }}
    <span class="btn-text-inner">
        {{ $slot }}
    </span>
</button>
