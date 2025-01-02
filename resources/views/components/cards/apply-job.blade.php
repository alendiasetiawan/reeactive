@props(['color' => ''])

<div {{ $attributes->class(['card card-apply-job']) }}>
    <div class="card-body">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <div class="flex-row d-flex">
                @isset($avatar)
                    <div {{ $attributes->merge(['class' => 'avatar me-1']) }}>
                        {{ $avatar }}
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

                <div class="user-info">
                    <h5 class="mb-0">
                        {{ $title }}
                    </h5>
                    <small class="text-muted">
                        @isset($subTitle)
                            {{ $subTitle }}
                        @endisset
                    </small>
                </div>
            </div>

            @isset($label)
                {{ $label }}
            @endisset
        </div>
        @isset($headingContent)
        <h5 {{ $attributes->merge(['class' => 'apply-job-title text-capitalize']) }}>
            {{ $headingContent }}
        </h5>
        @endisset
        <p class="mb-2 text-justify card-text text-capitalize">{{ $slot }}</p>

        @isset($highlight)
            <div class="rounded apply-job-package bg-light-primary">
                <div>
                    {{ $highlight }}
                </div>
                @isset($action)
                {{ $action }}
                @endisset
            </div>
        @endisset

        @isset($actionButton)
            {{ $actionButton }}
        @endisset

    </div>
</div>
