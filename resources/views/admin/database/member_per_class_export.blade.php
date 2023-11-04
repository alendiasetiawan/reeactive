<table>
    <thead>
        <tr>
            <th colspan="10">Data Member Coach {{ $coachNick }} ({{ $coachName }}) Di {{ $batchName }} -
            {{ $classQuery->day }} ({{ \Carbon\Carbon::parse($classQuery->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($classQuery->end_time)->format('H:i') }})</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Member</th>
            <th>Alamat</th>
            <th>Whatsapp</th>
            <th>Tinggi Badan</th>
            <th>Berat Badan</th>
            <th>Usia</th>
            <th>Kondisi Khusus</th>
            <th>Program</th>
            <th>Level</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($members as $member)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $member->member_name }}</td>
                <td>{{ $member->address }}</td>
                <td>{{ $member->mobile_phone }}</td>
                <td>{{ $member->body_height }} cm</td>
                <td>{{ $member->body_weight }} kg</td>
                <td>{{ $member->age_start }} tahun</td>
                <td>{{ $member->medical_condition }}</td>
                <td>{{ $member->program_name }}</td>
                <td>{{ $member->level_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
