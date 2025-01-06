<div {{ $attributes->merge([
    'class' => 'card card-employee-task'
]) }}>
    <div class="card-header flex-row justify-content-between">
        <h4 class="card-title">{{ $header }}</h4>
        @isset($option)
            <div>
                {{ $option }}
            </div>
        @endisset
        @isset($subHeader)
            {{ $subHeader }}
        @endisset
        {{-- <i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i> --}}
    </div>
    <div class="card-body">
        {{ $slot }}
        <!--Fill With Employee Task-->
    </div>
</div>
