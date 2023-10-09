<textarea {{ $attributes->class(['form-control'])->merge(['rows' => '3']) }}>
    {{ $slot }}
</textarea>
