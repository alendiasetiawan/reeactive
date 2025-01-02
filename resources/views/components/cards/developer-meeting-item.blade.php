<div class="meetings">
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start">
            <div class="avatar bg-light-primary rounded me-1">
                <div class="avatar-content">
                    {{ $icon }}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> --}}
                </div>
            </div>
            <div class="content-body">
                <h6 class="mb-0">{{ $title }}</h6>
                <small>{{ $subTitle }}</small>
            </div>
        </div>
        @isset($actionButton)
            <div class="d-flex justify-content-end align-self-center">
                {{ $actionButton }}
            </div>
        @endisset
    </div>
</div>
