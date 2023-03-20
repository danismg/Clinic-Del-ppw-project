@extends('layouts.master')
@section('title', 'Medicine')
@section('content')
    <div id="content_list">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <form id="content_filter">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                fill="black" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <input type="text" name="keyword"
                                        class="form-control form-control-solid w-250px ps-15"
                                        placeholder="Cari data obat..." />
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex my-6">
                                    <div class="btn-group me-3" role="group">
                                        <button id="aksi" type="button" class="btn btn-light-primary"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.3" x="12.75" y="4.25" width="12"
                                                        height="2" rx="1" transform="rotate(90 12.75 4.25)"
                                                        fill="currentColor"></rect>
                                                    <path
                                                        d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                        fill="#C4C4C4"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Export Report
                                        </button>
                                        <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                            aria-labelledby="aksi">
                                            <div class="menu-item px-3">
                                                <a href="javascript:;"
                                                    onclick="handle_open_modal('{{ route('medicine.input_export_pdf') }}','#modalListResult','#contentListResult');"
                                                    class="menu-link px-3">PDF</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="javascript:;"
                                                    onclick="handle_open_modal('{{ route('medicine.input_export_excel') }}','#modalListResult','#contentListResult');"
                                                    class="menu-link px-3">Excel</a>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" onclick="load_input('{{ route('medicine.create') }}');"
                                        class="btn btn-sm btn-primary me-3">Tambah Data</button>
                                    <button type="button" onclick="delete_all();" class="btn btn-sm btn-danger me-3">Hapus
                                        Data</button>
                                </div>
                            </div>
                    </form>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatables">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="check-all"
                                                    onclick="check_all(this);">
                                                <label class="custom-control-label" for="check-all"></label>
                                            </div>
                                        </th>
                                        <th class="min-w-125px">Nama Obat</th>
                                        <th class="min-w-125px">Jenis Obat</th>
                                        <th class="min-w-125px">Stok Obat</th>
                                        <th class="min-w-125px">Kategori Obat</th>
                                        <th class="text-end min-w-70px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content_input"></div>
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                serverSide: true,
                ajax: '{{ route('medicine.index') }}',
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                responsive: true,
                language: {
                    zeroRecords: "Tidak ada data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                }
            });

            $('input[name="keyword"]').on('keyup', function(e) {
                $('#datatables').DataTable().search($(this).val()).draw();
            });
        });

        function check_all(el) {
            var is_checked = $(el).is(':checked');
            $('#datatables').find('tbody input[type="checkbox"]').prop('checked', is_checked);
        }

        function delete_all() {
            var ids = [];
            $('#datatables').find('tbody input[type="checkbox"]:checked').each(function(i) {
                ids[i] = $(this).val();
            });
            if (ids.length > 0) {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Data yang dipilih akan dihapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('medicine.delete_all') }}',
                            type: 'POST',
                            data: {
                                ids: ids,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.alert) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        $('#datatables').DataTable().ajax.reload();
                                        $('#datatables').find('tbody input[type="checkbox"]')
                                            .prop('checked', false);
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan saat menghapus data',
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                    });
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Batal!',
                            text: 'Konfirmasi dibatalkan',
                            icon: 'info',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: "Pilih data yang akan dihapus!",
                    text: "",
                    icon: "warning",
                    confirmButtonText: 'Ok'
                });
            }
        }
    </script>
@endsection
@endsection
