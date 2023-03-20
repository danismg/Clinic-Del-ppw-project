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
                        Data Tenaga Medis
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
                            <input type="text" class="form-control" id="nama" name="name"
                                placeholder="Masukkan Nama Tenaga Medis..." value="{{ $data->name }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">NIK</label>
                            <input type="number" class="form-control" id="identity_number" name="identity_number"
                                placeholder="Masukkan NIK..." value="{{ $data->identity_number }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Profesi</label>
                            <input type="text" class="form-control" id="profession" name="profession"
                                placeholder="Masukkan Profesi..." value="{{ $data->profession }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Jabatan</label>
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Masukkan Jabatan..." value="{{ $data->position }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Pendidikan</label>
                            <input type="text" class="form-control" id="education" name="education"
                                placeholder="Masukkan Pendidikan..." value="{{ $data->education }}">
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
                                placeholder="Masukkan Alamat..." value="{{ $data->address }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email..." value="{{ $data->email }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">No. HP</label>
                            <input type="number" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Masukkan No. HP..." value="{{ $data->phone_number }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="min-w-150px mt-10 text-end">
                            @if ($data->id)
                                <button id="tombol_simpan"
                                    onclick="handle_save('#tombol_simpan','#form_input','{{ route('medicalPersonel.update', $data->id) }}','PATCH');"
                                    class="btn btn-sm btn-primary">Simpan</button>
                            @else
                                <button id="tombol_simpan"
                                    onclick="handle_save('#tombol_simpan','#form_input','{{ route('medicalPersonel.store') }}','POST');"
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
