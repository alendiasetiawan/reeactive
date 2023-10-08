<button {{ $attributes->class(['btn rounded bs-popover'])->merge(['data-bs-placement' => 'top', 'data-bs-content' => '', 'type' => 'button', 'data-bs-container' => 'body']) }}>
    {{ $slot }}
</button>
