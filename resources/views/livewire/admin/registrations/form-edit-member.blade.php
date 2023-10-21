<div>
    <div class="row">
        <div class="col-12 mb-2">
            <x-inputs.label>Level</x-inputs.label>
            <x-inputs.select wire:model.live='selectedLevel'>
                <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                <x-inputs.select-option value="1">Beginner 1.0</x-inputs.select-option>
                <x-inputs.select-option value="2">Beginner 2.0</x-inputs.select-option>
                <x-inputs.select-option value="3">Intermediate</x-inputs.select-option>
            </x-inputs.select>
        </div>
        <div class="col-12 mb-2">
            <x-inputs.label>Coach</x-inputs.label>
            <x-inputs.select wire:model.live='selectedCoach'>
                <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                @foreach ($this->coaches as $id => $coach)
                <x-inputs.select-option value="{{ $id }}">Coach {{ $coach }}</x-inputs.select-option>
                @endforeach
            </x-inputs.select>
        </div>
        <div class="col-12 mb-2">
            <x-inputs.label>Kelas</x-inputs.label>
            <x-inputs.select wire:model.live='selectedClass'>
                <x-inputs.select-option value="">--Pilih--</x-inputs.select-option>
                @foreach ($this->classes as $class)
                <x-inputs.select-option value="{{ $class->id }}">
                    {{ $class->day }}
                    ({{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }})
                </x-inputs.select-option>
                @endforeach
            </x-inputs.select>
        </div>
    </div>
</div>
