<?php

namespace App\Http\Controllers;

use App\Models\MedicalPersonel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MedicalPersonelApiController extends Controller
{
    public function index()
    {
        $medicalPersonel = MedicalPersonel::all();
        return response()->json([
            'message' => 'Berhasil nampilin medicalPersonel',
            'medicalRecord' => $medicalPersonel
        ], 200);
    }
    // buka ke halaman tak lengkap atau sebagian data
    public function create()
    {
        //
    }

    // namabh ke database
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email|max:255',
        // ]);
        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'identity_number.required' => 'NIK tidak boleh kosong',
            'profession.required' => 'Profesi tidak boleh kosong',
            'position.required' => 'Jabatan tidak boleh kosong',
            'education.required' => 'Pendidikan tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'subdistrict_id.required' => 'Kecamatan tidak boleh kosong',
            'city_id.required' => 'Kota tidak boleh kosong',
            'province_id.required' => 'Provinsi tidak boleh kosong',
            'phone_number.required' => 'Nomor Telepon tidak boleh kosong',
            'phone_number.numeric' => 'Nomor Telepon harus berupa angka',
            'phone_number.digits_between' => 'Nomor Telepon harus diantara 10 sampai 12 karakter',
            'phone_number.unique' => 'Nomor Telepon sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ];

        $validators = Validator::make($request->all(), [
            'name' => 'required|string',
            'identity_number' => 'required',
            'profession' => 'required',
            'position' => 'required',
            'education' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            'phone_number' => 'required|numeric|digits_between:10,12|unique:medical_personels',
            'email' => 'required|email|unique:medical_personels',
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
            } elseif ($errors->has('profession')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('profession'),
                ]);
            } elseif ($errors->has('position')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('position'),
                ]);
            } elseif ($errors->has('education')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('education'),
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
            } elseif ($errors->has('phone_number')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('phone_number'),
                ]);
            } elseif ($errors->has('email')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }
        }

        $medicalPersonel = MedicalPersonel::create([
            'name' => $request->name,
            'identity_number' => $request->identity_number,
            'profession' => $request->profession,
            'position' => $request->position,
            'education' => $request->education,
            'address' => $request->address,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'subdistrict_id' => $request->subdistrict_id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
        return response()->json([
            'message' => 'Berhasil nambah medicalPersonel',
            'medicalPersonel' => $medicalPersonel
        ], 201);
    }

    // menampilkan halaman detail person
    public function show($id)
    {
        //
    }
    // menampilkan halaman 
    public function edit($id)
    {
        //
    }

    public function update(Request $request, MedicalPersonel $medicalPersonel)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.regex' => 'Nama hanya boleh mengandung huruf, spasi, dan angka',
            'identity_number.required' => 'NIK tidak boleh kosong',
            'profession.required' => 'Profesi tidak boleh kosong',
            'position.required' => 'Jabatan tidak boleh kosong',
            'education.required' => 'Pendidikan tidak boleh kosong',
            'address.required' => 'Alamat tidak boleh kosong',
            'subdistrict_id.required' => 'Kecamatan tidak boleh kosong',
            'city_id.required' => 'Kota tidak boleh kosong',
            'province_id.required' => 'Provinsi tidak boleh kosong',
            'phone_number.required' => 'Nomor Telepon tidak boleh kosong',
            'phone_number.numeric' => 'Nomor Telepon harus berupa angka',
            'phone_number.digits_between' => 'Nomor Telepon harus diantara 10 sampai 12 karakter',
            'phone_number.unique' => 'Nomor Telepon sudah terdaftar',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ];
        $validators = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/',
            'identity_number' => 'required',
            'profession' => 'required',
            'position' => 'required',
            'education' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'subdistrict_id' => 'required',
            'phone_number' => 'required|numeric|digits_between:10,12|unique:medical_personels,phone_number,' . $medicalPersonel->id,
            'email' => 'required|email|unique:medical_personels,email,' . $medicalPersonel->id,
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
            } elseif ($errors->has('profession')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('profession'),
                ]);
            } elseif ($errors->has('position')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('position'),
                ]);
            } elseif ($errors->has('education')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('education'),
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
                    'message' => $errors->first('subdistress_id'),
                ]);
            } elseif ($errors->has('phone_number')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('phone_number'),
                ]);
            } elseif ($errors->has('email')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }
        }

        $medicalPersonel->update($request->all());
        return response()->json([
            'message' => 'Berhasil update medicalPersonel',
            'medicalRecord' => $medicalPersonel
        ], 201);
    }

    public function destroy($id)
    {
        $medicalPersonel = MedicalPersonel::where('id', $id)->delete();
        return response()->json([
            'message' => 'Berhasil hapus medicalRecord',
            'medicalPersonel' => $medicalPersonel
        ], 200);
    }
}
