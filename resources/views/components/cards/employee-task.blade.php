@props(['color' => ''])

<div {{ $attributes->merge([
    'class' => 'employee-task d-flex justify-content-between align-items-center'
]) }}>
    <div class="d-flex flex-row">
        @isset($avatar)
            <div class="avatar me-75">
                {{ $avatar }}
                {{-- <img src="../../../app-assets/images/portrait/small/avatar-s-9.jpg" class="rounded" width="42" height="42" alt="Avatar" /> --}}
            </div>
        @endisset
        @isset($avatarIcon)
            <div {{ $attributes->merge(['class' => 'me-50 avatar rounded bg-light-'.$color]) }}>
                <div class="avatar-content">
                    <h4 class="mt-1">
                        {{ $avatarIcon }}
                    </h4>
                </div>
            </div>
        @endisset
        <div class="my-auto">
            <h6 class="mb-0">{{ $title }}</h6>
            <small>{{ $subTitle }}</small>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <small class="text-muted">{{ $label }}</small>
        @isset($action)
            {{-- <div class="employee-task-chart-primary-1"></div> --}}
            <div>
                {{ $action }}
            </div>
        @endisset
    </div>
</div>
