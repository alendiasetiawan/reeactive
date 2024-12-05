<div class="card card-employee-task">
    <div class="card-header">
        <h4 class="card-title">{{ $header }}</h4>
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
