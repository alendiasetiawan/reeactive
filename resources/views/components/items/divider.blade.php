@props([
    'color' => 'dark',
    'position' => 'center'
])

<div class="divider divider-{{ $position }} divider-{{ $color }}">
    <div class="divider-text">{{ $slot }}</div>
</div>
