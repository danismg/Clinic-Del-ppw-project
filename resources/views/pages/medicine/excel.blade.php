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
                        <h5>Laporan Data Obat</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <h5>BULAN {{ \Carbon\Carbon::parse($date)->translatedFormat('F') }} TAHUN
                            {{ \Carbon\Carbon::parse($date)->year }}</h5>
                    </td>
                </tr>
                <tr>
                    <th>No</th>
                    <th style="width: 100px;">Nama Obat</th>
                    <th style="width: 150px;">Jumlah Obat Masuk</th>
                    <th style="width: 150px;">Jumlah Obat Keluar</th>
                    <th style="width: 200px;">Jumlah Sisa Stok Obat Bulan Ini</th>
                    <th style="width: 200px;">Jumlah Sisa Stok Obat Bulan Lalu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity_in }}</td>
                        <td>{{ $item->quantity_out }}</td>
                        <td>{{ $item->quantity_remaining }}</td>
                        <td>
                            {{ \App\Helpers\Helper::getMedicineRemainingLastMonth($item->id, date('Y-m')) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
