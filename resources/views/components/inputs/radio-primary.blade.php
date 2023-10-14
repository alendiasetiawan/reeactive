<div class="form-check form-check-primary form-check-inline">
    {{ $slot }}
    <label {{ $labelRadio->attributes->merge([
        'class' => 'form-check-label',
        'for' => 'label-radio-one' ?? ''
    ])}}>
        {{ $labelRadio }}
    </label>
</div>
