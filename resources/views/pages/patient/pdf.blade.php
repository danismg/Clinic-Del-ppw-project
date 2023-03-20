<html>

<head>
    <title>Resume Medis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        .page-break {
            page-break-after: always;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;

            /** Extra personal styles **/
            background-color: white;
            color: black;
            text-align: left;
            font-size: 10px;
        }

    </style>
    @foreach ($data->medical_records as $item)
        <center>
            <h5>Resume Medis</h5>
        </center>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $data->identity_number }}</td>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Umur/Tanggal Lahir</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($data->birth_date)->age . ' Tahun, ' . \Carbon\Carbon::parse($data->birth_date)->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $data->address . ', ' . $data->subdistrict->name . ', ' . $data->city->name . ', ' . $data->province->name }}
                </td>
            </tr>
            <tr>
                <td>No BPJS</td>
                <td>:</td>
                <td>{{ $data->bpjs_number }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>{{ $data->status }}</td>
            </tr>
        </table>
        <br>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>Anamnesa</th>
                    <th>Pemeriksaan Fisik</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <table class="table-borderless">
                            <tr>
                                <td>Anamnesa</td>
                                <td>:</td>
                                <td>{{ $item->history }}</td>
                            </tr>
                            <tr>
                                <td>Penatalaksaaan dan Edukasi</td>
                                <td>:</td>
                                <td>{{ $item->treatment }}</td>
                            </tr>
                            <tr>
                                <td>Diagnosa</td>
                                <td>:</td>
                                <td>{{ $item->diagnosis }}</td>
                            </tr>
                            <tr>
                                <td>Detail Obat</td>
                                <td>:</td>
                                <td>
                                    <ul style="list-style-type: none;">
                                        @foreach ($item->medicines as $medicine)
                                            <li>{{ $medicine->medicine->name . ', ' . $medicine->quantity . ' | ' . $medicine->procedure }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table-borderless">
                            <tr>
                                <td>Tinggi Badan</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->height }}</td>
                            </tr>
                            <tr>
                                <td>Berat Badan</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->weight }}</td>
                            </tr>
                            <tr>
                                <td>Lingkar Perut</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->belly_circumference }}</td>
                            </tr>
                            <tr>
                                <td>IMT</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->bmi }}</td>
                            </tr>
                            <tr>
                                <td>Sistole</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->sistole }}</td>
                            </tr>
                            <tr>
                                <td>Diastole</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->diastole }}</td>
                            </tr>
                            <tr>
                                <td>Respiratory Rate</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->respiratory_rate }}</td>
                            </tr>
                            <tr>
                                <td>Heart Rate</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->heart_rate }}</td>
                            </tr>
                            <tr>
                                <td>KLL</td>
                                <td>:</td>
                                <td>{{ $item->physicalExamination->status }}</td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">Paraf Dokter</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <footer>
            <hr>
            Laporan Rekam Medis
            {{ $data->name . ' - ' . \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
        </footer>
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>
