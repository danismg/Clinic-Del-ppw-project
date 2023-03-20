<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Exports\PatientExport;
use App\Http\Controllers\Controller;
use Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Patient::all())
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group" role="group">
                    <a href="' . route('patient.medical_record', $data->id) . '" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <a href="javascript:;" onclick="load_detail(\'' . route('patient.show', $data->id) . '\');" class="btn btn-sm btn-info">
                        <i class="fas fa-solid fa-eye"></i>
                    </a>
                    <a href="javascript:;" onclick="load_input(\'' . route('patient.edit', $data->id) . '\');" class="btn btn-sm btn-warning">
                        <i class="fas fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('patient.destroy', $data->id) . '\');" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>';
                })
                ->addColumn('age', function ($data) {
                    return Carbon::parse($data->birth_date)->age;
                })
                ->addColumn('gender', function ($data) {
                    if ($data->gender == 'male') {
                        return "Laki-laki";
                    } else {
                        return "Perempuan";
                    }
                })
                ->rawColumns(['action', 'age'])
                ->make(true);
        }
        return view('pages.patient.main');
    }

    public function create()
    {
        $provinces = Province::all();
        return view('pages.patient.input', ['data' => new Patient, 'provinces' => $provinces]);
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Pasien harus diisi',
            'name.regex' => 'Nama Pasien harus berupa huruf',
            'identity_number.required' => 'Nomor Identitas harus diisi',
            'identity_number.unique' => 'Nomor Identitas sudah ada',
            'birth_date.required' => 'Tanggal Lahir harus diisi',
            'address.required' => 'Alamat harus diisi',
            'province_id.required' => 'Pilih Provinsi',
            'city_id.required' => 'Pilih Kota',
            'subdistrict_id.required' => 'Pilih Kecamatan',
            'bpjs_number.required' => 'Nomor BPJS harus diisi',
            'gender.required' => 'Pilih Jenis Kelamin Pasien',
            'status.required' => 'Pilih Status Pasien'
        ];

        $validators = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'identity_number' => 'required|unique:patients',
            'birth_date' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            'bpjs_number' => 'required',
            'gender' => 'required',
            'status' => 'required',
        ], $messages);


        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('name')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            } elseif ($errors->has('identity_number')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('identity_number'),
                ]);
            } elseif ($errors->has('birth_date')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('birth_date'),
                ]);
            } elseif ($errors->has('address')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('address'),
                ]);
            } elseif ($errors->has('province_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('province_id'),
                ]);
            } elseif ($errors->has('city_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('city_id'),
                ]);
            } elseif ($errors->has('subdistrict_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('subdistrict_id'),
                ]);
            } elseif ($errors->has('bpjs_number')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('bpjs_number'),
                ]);
            } elseif ($errors->has('gender')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('gender'),
                ]);
            } elseif ($errors->has('status')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('status'),
                ]);
            }
        }

        Patient::create($request->all());

        return response([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function show(Patient $patient)
    {
        return view('pages.patient.show', ['data' => $patient]);
    }

    public function pdf(Patient $patient)
    {
        $pdf = PDF::loadview('pages.patient.pdf', ['data' => $patient]);
        return $pdf->download($patient->name . '.pdf');
    }

    public function edit(Patient $patient)
    {
        $provinces = Province::all();
        return view('pages.patient.input', ['data' => $patient, 'provinces' => $provinces]);
    }

    public function update(Request $request, Patient $patient)
    {
        $messages = [
            'name.required' => 'Nama Pasien harus diisi',
            'name.regex' => 'Nama Pasien harus berupa huruf',
            'identity_number.required' => 'Nomor Identitas harus diisi',
            'identity_number.numeric' => 'Nomor Identitas harus berupa angka',
            'identity_number.unique' => 'Nomor Identitas sudah ada',
            'birth_date.required' => 'Tanggal Lahir harus diisi',
            'address.required' => 'Alamat harus diisi',
            'province_id.required' => 'Pilih Provinsi',
            'city_id.required' => 'Pilih Kota',
            'subdistrict_id.required' => 'Pilih Kecamatan',
            'bpjs_number.required' => 'Nomor BPJS harus diisi',
            'gender.required' => 'Pilih Jenis Kelamin Pasien',
            'status.required' => 'Pilih Status Pasien'
        ];

        $validators = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'identity_number' => 'required|numeric|unique:patients,identity_number,' . $patient->id,
            'birth_date' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            'bpjs_number' => 'required',
            'gender' => 'required',
            'status' => 'required',
        ], $messages);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('name')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            } elseif ($errors->has('identity_number')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('identity_number'),
                ]);
            } elseif ($errors->has('birth_date')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('birth_date'),
                ]);
            } elseif ($errors->has('address')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('address'),
                ]);
            } elseif ($errors->has('province_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('province_id'),
                ]);
            } elseif ($errors->has('city_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('city_id'),
                ]);
            } elseif ($errors->has('subdistrict_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('subdistrict_id'),
                ]);
            } elseif ($errors->has('bpjs_number')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('bpjs_number'),
                ]);
            } elseif ($errors->has('gender')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('gender'),
                ]);
            } elseif ($errors->has('status')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('status'),
                ]);
            }
        }

        $patient->update($request->all());

        return response([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }

    public function export()
    {
        $date = Patient::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year')->distinct()->get();

        return view('pages.medicalRecord.export', ['date' => $date]);
    }

    public function excel(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'date' => 'required',
        ]);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('date')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('date'),
                ]);
            }
        }

        $fileName = 'Data Pasien ' . $request->date . '.xlsx';
        return Excel::download(new PatientExport($request->date), $fileName);
    }
}
