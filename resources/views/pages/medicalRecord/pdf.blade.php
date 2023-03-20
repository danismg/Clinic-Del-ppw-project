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
    <center>
        <h5>Resume Medis</h5>
    </center>
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $medicalRecord->patient->name }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $medicalRecord->patient->identity_number }}</td>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($medicalRecord->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Umur/Tanggal Lahir</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($medicalRecord->patient->birth_date)->age . ' Tahun, ' . \Carbon\Carbon::parse($medicalRecord->patient->birth_date)->translatedFormat('d F Y') }}
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $medicalRecord->patient->address . ', ' . $medicalRecord->patient->subdistrict->name . ', ' . $medicalRecord->patient->city->name . ', ' . $medicalRecord->patient->province->name }}
            </td>
        </tr>
        <tr>
            <td>No BPJS</td>
            <td>:</td>
            <td>{{ $medicalRecord->patient->bpjs_number }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $medicalRecord->patient->status }}</td>
        </tr>
        <tr>
            <td>Tenaga Medis</td>
            <td>:</td>
            <td>{{ $medicalRecord->medical_personel->name }}</td>
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
                            <td>{{ $medicalRecord->history }}</td>
                        </tr>
                        <tr>
                            <td>Penatalaksaaan dan Edukasi</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->treatment }}</td>
                        </tr>
                        <tr>
                            <td>Diagnosa</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->diagnosis }}</td>
                        </tr>
                        <tr>
                            <td>Detail Obat</td>
                            <td>:</td>
                            <td>
                                <ul style="list-style-type: none; margin-left: -40px">
                                    @foreach ($medicalRecord->medicines as $medicine)
                                        <li>
                                            {{ $medicine->medicine->name . ', ' . $medicine->quantity . ' | ' . $medicine->procedure }}
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
                            <td>{{ $medicalRecord->physicalExamination->height }}</td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->weight }}</td>
                        </tr>
                        <tr>
                            <td>Lingkar Perut</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->belly_circumference }}</td>
                        </tr>
                        <tr>
                            <td>IMT</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->bmi }}</td>
                        </tr>
                        <tr>
                            <td>Sistole</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->sistole }}</td>
                        </tr>
                        <tr>
                            <td>Diastole</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->diastole }}</td>
                        </tr>
                        <tr>
                            <td>Respiratory Rate</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->respiratory_rate }}</td>
                        </tr>
                        <tr>
                            <td>Heart Rate</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->heart_rate }}</td>
                        </tr>
                        <tr>
                            <td>KLL</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->status }}</td>
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
        {{ $medicalRecord->patient->name . ' - ' . \Carbon\Carbon::parse($medicalRecord->created_at)->translatedFormat('d F Y') }}
    </footer>
</body>

</html>
