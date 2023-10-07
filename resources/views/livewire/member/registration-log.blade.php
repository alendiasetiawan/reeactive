<div class="col-lg-4 col-md-5 col-12 mb-3">
    <x-cards.activity>
        <x-slot name="cardTitle">Riwayat Registrasi</x-slot>
        @foreach ($registrationLogs as $log)
        <x-cards.activity-item>
            <x-slot name="icon" class="t-success"><b style="color: white">{{ $loop->iteration }}</b></x-slot>
            <x-slot name="mainActivity">{{ $log->batch_name }} - Coach {{ $log->nick_name }}</x-slot>
            <x-slot name="time">{{ $log->created_at->diffForHumans() }}</x-slot>
            <x-slot name="label">
                @if ($log->payment_status == 'Done')
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle text-success"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle text-warning"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                @endif

            </x-slot>
        </x-cards.activity-item>
        @endforeach
    </x-cards.activity>
</div>
