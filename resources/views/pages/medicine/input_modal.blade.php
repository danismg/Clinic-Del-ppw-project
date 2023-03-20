<div class="modal-header">
    <h5 class="modal-title">Tambah Stok Obat</h5>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="las la-times"></i>
    </div>
</div>
<div class="modal-body">
    <form id="form_input_modal">
        <div class="row">
            <div class="col-lg-4">
                <label class="required fs-6 fw-bold mb-2">Nama</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan nama..."
                    value="{{ $data->name }}" readonly>
            </div>
            <div class="col-lg-6 mb-5">
                <label for="condition" class="required form-label">Stok</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    placeholder="Masukkan Jumlah Obat...">
            </div>
            <div class="min-w-150px mt-10 text-end">
                <button id="tombol_simpan_modal"
                    onclick="handle_save_modal('#tombol_simpan_modal','#form_input_modal','{{ route('medicine.update_modal', $data->id) }}','PATCH','#modalListResult');"
                    class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
