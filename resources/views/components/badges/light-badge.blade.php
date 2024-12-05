@props(['margin'=> '', 'color'=>''])
<span class="{{ $margin }} badge badge-light-{{ $color }}">
    {{ $slot }}
</span>
