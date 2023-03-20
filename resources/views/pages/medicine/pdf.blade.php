<html>

<head>
    <title>Data Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Laporan Data Obat {{ \Carbon\Carbon::parse($date)->translatedFormat('F') }}
            {{ \Carbon\Carbon::parse($date)->year }}</h5>
    </center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Jumlah Obat Masuk</th>
                <th>Jumlah Obat Keluar</th>
                <th>Jumlah Sisa Stok Obat Bulan Ini</th>
                <th>Jumlah Sisa Stok Obat Bulan Lalu</th>
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
                    <td>{{ \App\Helpers\Helper::getMedicineRemainingLastMonth($item->id, date('Y-m')) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
