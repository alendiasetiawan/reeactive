@props([
    'color' => 'primary' ?? ''
])

<div
{{ $attributes->merge([
    'class' => 'spinner-border spinner-border-sm',
    'role' => 'status',
]) }}
class="spinner-border spinner-border-sm text-{{ $color }}" role="status">
    <span class="visually-hidden">Loading...</span>
</div>
