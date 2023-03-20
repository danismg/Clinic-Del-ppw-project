<div class="modal-header">
    <h5 class="modal-title">Export Excel</h5>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="las la-times"></i>
    </div>
</div>
<div class="modal-body">
    <form id="form_input_modal" action="{{ route('patient.excel') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12 mb-5">
                <label for="condition" class="required form-label">Pilih Tanggal</label>
                <div class="input-group">
                    <select data-control="select2" data-placeholder="Pilih Bulan" id="date" name="date"
                        class="form-select form-select-solid @error('tanggal') is-invalid @enderror">
                        <option SELECTED DISABLED>Pilih Bulan</option>
                        @foreach ($date as $item)
                            <option value="{{ $item->year . '-' . $item->month }}">
                                {{ $item->year . '-' . $item->month }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="min-w-150px mt-10 text-end">
                <button id="tombol_simpan_modal" type="submit"
                    onclick="handle_export_modal('#tombol_simpan_modal','#modalListResult');"
                    class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script>
    obj_select('date', 'Pilih Bulan');
</script>
