@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <!--begin::List Widget 7-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <form id="filter_obat">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-bolder text-dark">List Obat</span>
                                </h3>
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <input type="hidden" name="type" value="medicine">
                                        <input type="text" name="medicine"
                                            class="form-control form-control-solid w-250px ps-15"
                                            placeholder="Cari nama obat..." />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-header align-items-center border-0 mt-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_medicine">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Nama Obat</th>
                                            <th class="min-w-125px">Sediaan Obat</th>
                                            <th class="min-w-125px">Penggunaan Obat</th>
                                            <th class="min-w-125px">Sisa Obat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List Widget 7-->
                </div>
                <div class="col-xl-6">
                    <!--begin::List Widget 7-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <form id="filter_pasien">
                            <div class="card-header border-0 pt-6">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="fw-bolder text-dark">List Pasien</span>
                                </h3>
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1 me-3">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                                    rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path
                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <input type="text" name="patient"
                                            class="form-control form-control-solid w-250px ps-15"
                                            placeholder="Cari nama pasien..." />
                                    </div>
                                    <div class="d-flex justify-content-end me-3">
                                        <select class="form-select form-select-solid" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="Siswa DEL">Siswa DEL</option>
                                            <option value="Mahasiswa DEL">Mahasiswa DEL</option>
                                            <option value="Karyawan DEL">Karyawan DEL</option>
                                            <option value="BPJS Umum">BPJS Umum</option>
                                            <option value="Umum">Umum</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-header align-items-center border-0 mt-4">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 w-100" id="table_patient">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-125px">Nama Pasien</th>
                                            <th class="min-w-125px">Umur</th>
                                            <th class="min-w-125px">No BPJS</th>
                                            <th class="min-w-125px">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">

                                    </tbody>
                                </table>
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List Widget 7-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#table_medicine').DataTable({
                serverSide: true,
                ajax: '{{ route('dashboard.medicine') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'usage',
                        name: 'usage'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                language: {
                    zeroRecords: "Tidak ada data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                }
            });

            $('#table_patient').DataTable({
                serverSide: true,
                ajax: '{{ route('dashboard.patient') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'bpjs_number',
                        name: 'bpjs_number'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                language: {
                    zeroRecords: "Tidak ada data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                }
            });
            // search 
            $('input[name="medicine"]').on('keyup', function() {
                $('#table_medicine').DataTable().search($(this).val()).draw();
            });

            $('input[name="patient"]').on('keyup', function() {
                $('#table_patient').DataTable().search($(this).val()).draw();
            });

            $('select[name="status"]').on('change', function() {
                if ($(this).val() == '') {
                    $('#table_patient').DataTable().columns(3).search($(this).val()).draw();
                } else {
                    $('#table_patient').DataTable().columns(3).search('^' + $(this).val() + '$', true,
                        false,
                        true).draw();
                }
            })
        });
    </script>
@endsection
@endsection
