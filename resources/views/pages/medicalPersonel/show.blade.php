<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h6>Data Tenaga Kesehatan</h6>
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
                        <td>Profesi</td>
                        <td>:</td>
                        <td>{{ $data->profession }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>:</td>
                        <td>{{ $data->position }}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td>{{ $data->education }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $data->address . ', ' . $data->subdistrict->name . ', ' . $data->city->name . ', ' . $data->province->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <td>No Hp</td>
                        <td>:</td>
                        <td>{{ $data->phone_number }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
