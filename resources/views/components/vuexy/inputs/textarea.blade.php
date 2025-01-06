<textarea
    {{ $attributes->merge([
        'type' => 'text',
        'class' => 'form-control',
        'rows' => '3' ?? '',
    ]) }}>
{{ $slot }}
</textarea>
