<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h6>Data Rekam Medis</h6>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        <a target="_blank"
                            href="{{ route('patient.medical_record.pdf', [$medicalRecord->patient->id, $medicalRecord->id]) }}"
                            class="btn btn-sm btn-primary me-2">Cetak PDF</a>
                        <button type="button" onclick="back();" class="btn btn-sm btn-primary">Kembali</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->patient->name }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->patient->identity_number }}</td>
                        </tr>
                        <tr>
                            <td>Umur/Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($medicalRecord->patient->birth_date)->age . 'Tahun ' }}
                                / {{ \Carbon\Carbon::parse($medicalRecord->patient->birth_date)->format('d-m-Y') }}
                            </td>
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
                            <td>Kasus Kecelakaan</td>
                            <td>:</td>
                            <td>{{ $medicalRecord->physicalExamination->status }}</td>
                        </tr>
                        <tr>
                            <td>Detail Obat</td>
                            <td>:</td>
                            <td>
                                <ul style="list-style-type: none;">
                                    @foreach ($medicalRecord->medicines as $medicine)
                                        <li>{{ $medicine->medicine->name . ', ' . $medicine->quantity . ' | ' . $medicine->procedure }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
