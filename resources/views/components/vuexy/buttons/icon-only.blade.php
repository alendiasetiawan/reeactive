@props(['color'])

<button {{ $attributes->class(['btn btn-icon btn-sm btn-outline-'.$color.''])->merge(['type' => 'button']) }}>
    {{ $slot }}
</button>
