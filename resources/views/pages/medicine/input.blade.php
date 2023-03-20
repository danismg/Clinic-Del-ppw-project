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
                        Data Obat
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
                        <div class="col-lg-6 mb-5">
                            <label for="condition" class="required form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukkan Nama Obat..." value="{{ $data->name }}">
                        </div>
                        <div class="col-lg-6 mb-5">
                            <label for="condition" class="required form-label">Jenis/Sediaan Obat</label>
                            <select class="form-control" id="type" name="type">
                                <option>Pilih Sediaan Obat</option>
                                <option value="TABLET" {{ $data->type == 'TABLET' ? 'selected' : '' }}>Tablet</option>
                                <option value="BOTOL" {{ $data->type == 'BOTOL' ? 'selected' : '' }}>Botol</option>
                                <option value="BOX" {{ $data->type == 'BOX' ? 'selected' : '' }}>Box</option>
                                <option value="PCS" {{ $data->type == 'PCS' ? 'selected' : '' }}>Pcs</option>
                                <option value="TUBE" {{ $data->type == 'TUBE' ? 'selected' : '' }}>Tube</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-5">
                            <label for="condition" class="required form-label">Jumlah/Stok</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Masukkan Jumlah Obat..." value="{{ $data->quantity }}">
                        </div>
                        <div class="col-lg-6 mb-5">
                            <label for="condition" class="required form-label">Kategori Obat</label>
                            <input type="text" class="form-control" id="category" name="category"
                                placeholder="Masukkan Kategori Obat..." value="{{ $data->category }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="min-w-150px mt-10 text-end">
                            @if ($data->id)
                                <button id="tombol_simpan"
                                    onclick="handle_save('#tombol_simpan','#form_input','{{ route('medicine.update', $data->id) }}','PATCH', 'Simpan');"
                                    class="btn btn-sm btn-primary">Simpan</button>
                            @else
                                <button id="tombol_simpan"
                                    onclick="handle_save('#tombol_simpan','#form_input','{{ route('medicine.store') }}','POST', 'Simpan');"
                                    class="btn btn-sm btn-primary">Simpan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
