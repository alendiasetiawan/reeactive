<div class="form-check">
    <input {{ $attributes->class(['form-check-input'])->merge(['type' => 'checkbox']) }}/>
    <label {{ $label->attributes->merge(['class' => 'form-check-label', 'for' => '']) }}>
        {{ $label }}
    </label>
</div>
