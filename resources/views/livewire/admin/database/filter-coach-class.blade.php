<div>
    <form method="GET" action="{{ route('admin::excel_per_class') }}">
        <div class="row mb-2">
            <div class="col-lg-4 col-md-6 col-12">
                <x-inputs.label>Coach</x-inputs.label>
                <x-inputs.select wire:model.live='selectedCoach' name="coach_id">
                    <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                    @foreach ($this->coaches as $coach)
                        <x-inputs.select-option value="{{ $coach->id }}">Coach {{ $coach->nick_name }}</x-inputs.select-option>
                    @endforeach
                </x-inputs.select-option>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <x-inputs.label>Class</x-inputs.label>
                <x-inputs.select wire:model.live='selectedClass' name="class_id">
                    <x-inputs.select-option value="" selected>--Pilih--</x-inputs.select-option>
                    @if ($selectedCoach)
                        @foreach ($this->classes as $class)
                            <x-inputs.select-option value="{{ $class->id }}">
                                {{ $class->day }}
                                ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                            </x-inputs.select-option>
                        @endforeach
                    @endif
                </x-inputs.select>
            </div>
        </div>
        @if (empty($selectedClass))
            <button class="btn btn-dark" disabled>Download Excel</button>
        @else
            <button class="btn btn-info">Download Excel</button>
        @endif
    </form>
</div>
