<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h6>
                        @if ($data->id)
                            Ubah
                        @else
                            Tambah
                        @endif
                        Data Pasien
                    </h6>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        <button type="button" onclick="back();" class="btn btn-sm btn-primary">Kembali</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <form id="form_input">
                    <div class="row">
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama Pasien..." value="{{ $data->name }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">NIK</label>
                            <input type="text" class="form-control" id="identity_number" name="identity_number"
                                placeholder="Masukkan NIK pasien..." value="{{ $data->identity_number }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="male" {{ $data->gender == 'male' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="female" {{ $data->gender == 'female' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Tanggal Lahir</label>
                            <input class="form-control" id="kt_datepicker_1" name="birth_date"
                                placeholder="Tanggal Lahir" value="{{ $data->birth_date }}">
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="province" class="required form-label">Provinsi</label>
                            <select class="form-control" name="province_id" id="province" class="form-control">
                                <option value="" SELECTED DISABLED>Pilih Provinsi</option>
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $data->province_id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="city" class="required form-label">Kota</label>
                            <select class="form-control" id="city" name="city_id"></select>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="subdistrict" class="required form-label">Kecamatan</label>
                            <select class="form-control" id="subdistrict" name="subdistrict_id"></select>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Masukkan Alamat Pasien..." value="{{ $data->address }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">No. BPJS</label>
                            <input type="text" class="form-control" id="bpjs_number" name="bpjs_number"
                                placeholder="Masukkan Nomor BPJS Pasien..." value="{{ $data->bpjs_number }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option>Pilih Status</option>
                                <option value="Siswa DEL" {{ $data->status == 'Siswa DEL' ? 'selected' : '' }}>Siswa
                                    DEL
                                </option>
                                <option value="Mahasiswa DEL"
                                    {{ $data->status == 'Mahasiswa DEL' ? 'selected' : '' }}>
                                    Mahasiswa DEL</option>
                                <option value="Karyawan DEL" {{ $data->status == 'Karyawan DEL' ? 'selected' : '' }}>
                                    Karyawan
                                    DEL</option>
                                <option value="BPJS Umum" {{ $data->status == 'BPJS Umum' ? 'selected' : '' }}>BPJS
                                    Umum
                                </option>
                                <option value="Umum" {{ $data->status == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="min-w-150px mt-10 text-end">
                            @if ($data->id)
                                <button id="tombol_simpan"
                                    onclick="handle_save('#tombol_simpan','#form_input','{{ route('patient.update', $data->id) }}','PATCH');"
                                    class="btn btn-sm btn-primary">Simpan</button>
                            @else
                                <button id="tombol_simpan"
                                    onclick="handle_save('#tombol_simpan','#form_input','{{ route('patient.store') }}','POST');"
                                    class="btn btn-sm btn-primary">Simpan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    obj_select('province');
    obj_select('city');
    obj_select('subdistrict');
    obj_autosize('address');
    $("#kt_datepicker_1").flatpickr();
    $("#province").change(function() {
        $.post('{{ route('regional.city') }}', {
            province: $("#province").val()
        }, function(result) {
            $("#city").html(result);
        }, "html");
    });
    $("#city").change(function() {
        $.post('{{ route('regional.subdistrict') }}', {
            city: $("#city").val()
        }, function(result) {
            $("#subdistrict").html(result);
        }, "html");
    });
    @if ($data->province_id)
        $("#province").val('{{ $data->province_id }}');
        setTimeout(function() {
            $('#province').trigger('change');
            setTimeout(function() {
                $('#city').val('{{ $data->city_id }}');
                $('#city').trigger('change');
                setTimeout(function() {
                    $('#subdistrict').val('{{ $data->subdistrict_id }}');
                    $('#subdistrict').trigger('change');
                }, 500);
            }, 500);
        }, 100);
    @endif
</script>
