<div class="widget widget-activity-five">
    <div class="widget-heading">
        <h5 class="">{{ $cardTitle }}</h5>

        @isset($action)
            <div class="task-action">
                {{ $action }}
            </div>
        @endisset
    </div>

    <div class="widget-content">

        <div class="w-shadow-top"></div>

        <div class="mt-container mx-auto">
            <div class="timeline-line">
                {{ $slot }}
            </div>
        </div>

        <div class="w-shadow-bottom"></div>
    </div>
</div>
