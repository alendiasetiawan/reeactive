<div>
    <div class="row match-height">
        <!--Reguler Program Registration-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.congratulation>
                <x-slot:title>Registrasi <b class="text-primary">{{ $batchQuery->batch_name }}</b></x-slot:title>
                <x-slot:subTitle>
                    Total : {{ $totalMember }} Member
                    @if ($verificationRegulerProgram >= 1)
                        <br/>
                        <x-badges.light-badge color="danger">Menunggu Verifikasi : {{ $verificationRegulerProgram }}</x-badges.light-badge>
                    @endif
                </x-slot:subTitle>
                <x-slot:content>{{ \App\Helpers\CurrencyHelper::formatRupiah($totalIncomeReguler) }}</x-slot:content>
                <x-slot:actionButton>
                    <a href="{{ route('admin::payment_verification') }}" wire:navigate>
                        <x-buttons.basic color="primary">Cek Pembayaran</x-buttons.basic>
                    </a>
                </x-slot:actionButton>
                <x-slot:image>
                    <img src="{{ asset('style/app-assets/images/illustration/badge.svg') }}" class="congratulation-medal" alt="Medal Pic" height="100px"/>
                </x-slot:image>
            </x-cards.congratulation>
        </div>
        <!--#Reguler Program Registration-->

        <!--Kelas Lepasan Registration-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.congratulation>
                <x-slot:title>Registrasi <b class="text-primary">Kelas Lepasan</b></x-slot:title>
                <x-slot:subTitle>
                    Total : {{ $totalMemberLepasan }} Peserta
                    <br/>
                    <x-badges.light-badge color="danger">Menunggu Verifikasi : {{ $verificationLepasan }}</x-badges.light-badge>
                </x-slot:subTitle>
                <x-slot:content>{{ \App\Helpers\CurrencyHelper::formatRupiah($totalIncomeLepasan) }}</x-slot:content>
                <x-slot:actionButton>
                    <a href="{{ route('admin::lepasan_payment_verification') }}" wire:navigate>
                        <x-buttons.basic color="primary">Cek Pembayaran</x-buttons.basic>
                    </a>
                </x-slot:actionButton>
                <x-slot:image>
                    <img src="{{ asset('style/app-assets/images/illustration/zakat-money.webp') }}" class="congratulation-medal" alt="Medal Pic" width="85px" height="100px"/>
                </x-slot:image>
            </x-cards.congratulation>
        </div>
        <!--#Kelas Lepasan Registration-->

        <!--Percentage Renewal-->
        <div class="col-lg-4 col-md-6 col-12">
            <x-cards.congratulation>
                <x-slot:title>Persentase Renewal <b class="text-primary">{{ $batchQuery->batch_name }}</b></x-slot:title>
                <x-slot:subTitle>
                    Batch Sebelumnya : {{ $qtyLastMember }} Member
                </x-slot:subTitle>
                <x-slot:content>
                    <br/>
                    Renewal Member : {{ $renewalMember }}
                </x-slot:content>
                <x-slot:actionButton>
                    <b>{{ $percentRenewalMember }}%</b>
                    <div class="progress progress-bar-primary">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemax="100" style="width: {{ $percentRenewalMember }}%"></div>
                    </div>
                </x-slot:actionButton>
            </x-cards.congratulation>
        </div>
        <!--#Percentage Renewal-->
    </div>

    <div class="row">
        <!--Bar Chart Member per Coach-->
        <div class="col-lg-7 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Jumlah Member Per Coach <b class="text-primary">{{ $batchQuery->batch_name }}</b></x-slot:cardTitle>
                <div class="row">
                    <div class="col-12">
                        <div style="height: 300px;">
                            <livewire:livewire-column-chart key="{{ $this->barChartMemberPerCoach->reactiveKey() }}" :column-chart-model="$this->barChartMemberPerCoach"/>
                        </div>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
        <!--#Bar Chart Member per Coach-->

        <!--Pie Chart Registration Type-->
        <div class="col-lg-5 col-12">
            <x-cards.basic-card>
                <x-slot:cardTitle>Statistik Jenis Registrasi <b class="text-primary">{{ $batchQuery->batch_name }}</b></x-slot:cardTitle>
                <div class="row">
                    <div class="col-12">
                        <div style="height: 300px;">
                            <livewire:livewire-pie-chart key="{{ $this->pieChartRegistrationType->reactiveKey() }}" :pie-chart-model="$this->pieChartRegistrationType"/>
                        </div>
                    </div>
                </div>
            </x-cards.basic-card>
        </div>
        <!--#Pie Chart Registration Type-->
    </div>

    <div class="row">
        <!--Reguler Program Registered Member-->
        <div class="col-lg-6 col-12">
            <x-cards.timeline>
                <x-slot:header>Pendaftar Program Reguler</x-slot:header>
                @forelse ($latestRegistrationsReguler as $reguler)
                <x-cards.timeline-item-financial>
                    <x-slot:number>{{ $loop->iteration }}</x-slot:number>
                    <x-slot:title>
                        {{ $reguler->member_name }}
                        @if ($reguler->payment_status == 'Process')
                            <x-badges.light-badge color="warning">Proses</x-badges.light-badge>
                        @elseif ($reguler->payment_status == 'Done')
                            <x-badges.light-badge color="success">Selesai</x-badges.light-badge>
                        @else
                            <x-badges.light-badge color="danger">Invalid</x-badges.light-badge>
                        @endif
                    </x-slot:title>
                    <x-slot:label>
                        {{ \Carbon\Carbon::parse($reguler->created_at)->diffForHumans() }}
                    </x-slot:label>
                    <x-slot:content>
                        Coach {{ $reguler->nick_name }} - {{ $reguler->program_name }} <br/>
                        {{ $reguler->day }}
                        ({{ \Carbon\Carbon::parse($reguler->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($reguler->end_time)->format('H:i') }})
                    </x-slot:content>
                </x-cards.timeline-item-financial>
                @empty
                <div class="col-12">
                    <x-alerts.not-found />
                </div>
                @endforelse
            </x-cards.timeline>
        </div>
        <!--Reguler Program Registered Member-->

        <!--Kelas Lepasan Registered Participant-->
        <div class="col-lg-6 col-12">
            <x-cards.timeline>
                <x-slot:header>Pendaftar Kelas Lepasan</x-slot:header>
                @forelse ($latestRegistrationsLepasan as $lepasan)
                    <x-cards.timeline-item-financial>
                        <x-slot:number>{{ $loop->iteration }}</x-slot:number>
                        <x-slot:title>
                            {{ $lepasan->member_name }}
                            @if ($lepasan->payment_status == 'Process')
                                <x-badges.light-badge color="warning">Proses</x-badges.light-badge>
                            @elseif ($lepasan->payment_status == 'Done')
                                <x-badges.light-badge color="success">Selesai</x-badges.light-badge>
                            @else
                                <x-badges.light-badge color="danger">Invalid</x-badges.light-badge>
                            @endif
                        </x-slot:title>
                        <x-slot:label>
                            {{ \Carbon\Carbon::parse($lepasan->created_at)->diffForHumans() }}
                        </x-slot:label>
                        <x-slot:content>
                            Coach {{ $lepasan->nick_name }} - {{ $lepasan->program_name }} <br/>
                            {{ \App\Helpers\TanggalHelper::convertImplodeDay($lepasan->day) }}
                            ({{ \Carbon\Carbon::parse($lepasan->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($lepasan->end_time)->format('H:i') }})
                        </x-slot:content>
                    </x-cards.timeline-item-financial>
                @empty
                    <div class="col-12">
                        <x-alerts.not-found />
                    </div>
                @endforelse
            </x-cards.timeline>
        </div>
        <!--#Kelas Lepasan Registered Participant-->
    </div>
</div>
