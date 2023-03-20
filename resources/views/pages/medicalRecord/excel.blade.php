<html>

<head>
    <title>Data Obat</title>
</head>

<body>
    <div style="width: 800px">
        <table>
            <thead>
                <tr>
                    <td colspan="6">
                        <h5>LAPORAN PELAYANAN KLINIK DEL</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <h5>BULAN {{ \Carbon\Carbon::parse($date)->translatedFormat('F') }} TAHUN
                            {{ \Carbon\Carbon::parse($date)->year }}</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <h5>Total {{ $medical_records->count() }}</h5>
                    </td>
                </tr>
                <tr>
                    <th rowspan="2" style="width: 30px; text-align: center">No</th>
                    <th rowspan="2" style="width: 100px; text-align: center">Tanggal</th>
                    <th rowspan="2" style="width: 200px; text-align: center">Nama Pasien</th>
                    <th rowspan="2" style="width: 100px; text-align: center">Umur</th>
                    <th rowspan="2" style="width: 100px; text-align: center">Jenis Kelamin</th>
                    <th rowspan="2" style="width: 300px; text-align: center">Keluhan</th>
                    <th rowspan="2" style="width: 200px; text-align: center">Diagnosa</th>
                    <th colspan="3" style="width: 200px; text-align: center;">Terapi</th>
                    <th rowspan="2" style="width: 200px; text-align: center;">Keterangan</th>
                    <th rowspan="2" style="width: 200px; text-align: center;">dr Jaga</th>
                </tr>
                <tr>
                    <th style="width: 100px;">Nama Obat</th>
                    <th style="width: 50px;">Jumlah</th>
                    <th style="width: 50px;">Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medical_records as $item)
                    <tr>
                        <td></td>
                        <td style="font-weight: bold; text-align: center;">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($item->medicines as $medicine)
                        @if ($loop->first)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td style="text-align: center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                <td style="text-align: center">{{ $item->patient->name }}</td>
                                <td style="text-align: center">
                                    {{ \Carbon\Carbon::parse($item->patient->birth_date)->age }}
                                    Tahun</td>
                                <td style="text-align: center">
                                    @if ($item->patient->gender == 'male')
                                        L
                                    @else
                                        P
                                    @endif
                                </td>
                                <td>{{ $item->history }}</td>
                                <td>{{ $item->diagnosis }}</td>

                                <td style="text-align: center">
                                    {{ $medicine->medicine->name }}
                                </td>
                                <td style="text-align: center">
                                    {{ $medicine->quantity }}
                                </td>
                                <td style="text-align: center">
                                    {{ $medicine->medicine->type }}
                                </td>
                                <td>{{ $item->patient->status }}</td>
                                <td>{{ $item->medical_personel->name }}</td>
                            </tr>
                        @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center">
                                    {{ $medicine->medicine->name }}
                                </td>
                                <td style="text-align: center">
                                    {{ $medicine->quantity }}
                                </td>
                                <td style="text-align: center">
                                    {{ $medicine->medicine->type }}
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
