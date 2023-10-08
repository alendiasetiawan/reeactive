<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a wire:navigate {{ $mainPage->attributes->class(['href']) }}>
                    {{ $mainPage }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $currentPage }}</li>
        </ol>
    </nav>
</div>
