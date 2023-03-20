<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h6>Data Pasien</h6>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex my-4">
                        <button type="button" onclick="back();" class="btn btn-sm btn-primary me-2">Kembali</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>{{ $data->identity_number }}</td>
                    </tr>
                    <tr>
                        <td>Umur/Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ \App\Helpers\Helper::age($data->birth_date) . ' Tahun / ' . \App\Helpers\Helper::getDate($data->date_of_birth) }}
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
            </div>
        </div>
    </div>
</div>
