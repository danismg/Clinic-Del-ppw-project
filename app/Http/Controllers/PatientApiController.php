<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientApiController extends Controller
{
    public function index()
    {
        $patient = Patient::all();
        return response()->json([
            'message' => 'Berhasil nampilin patient',
            'patient' => $patient
        ], 200);
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

        $patient = Patient::create([
            'name' => $request->name,
            'identity_number' => $request->identity_number,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'subdistrict_id' => $request->subdistrict_id,
            'bpjs_number' => $request->bpjs_number,
            'gender' => $request->gender,
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Berhasil nambah patient',
            'patient' => $patient
        ], 201);
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

        return response()->json([
            'message' => 'Berhasil hapus patient',
            'patient' => $patient
        ], 200);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
