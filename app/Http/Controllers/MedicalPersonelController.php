<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\MedicalPersonel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MedicalPersonelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(MedicalPersonel::all())
                // nampilin button
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group" role="group">
                    <a href="javascript:;" onclick="load_detail(\'' . route('medicalPersonel.show', $data->id) . '\');" class="btn btn-sm btn-info">
                        <i class="fas fa-solid fa-eye"></i>
                    </a>
                    <a href="javascript:;" onclick="load_input(\'' . route('medicalPersonel.edit', $data->id) . '\');" class="btn btn-sm btn-warning">
                        <i class="fas fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('medicalPersonel.destroy', $data->id) . '\');" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>';
                })
                ->addColumn('address', function ($data) {
                    return $data->address . ', ' . ',' . $data->subdistrict->name . ', ' . $data->city->name . ', ' . $data->province->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.medicalPersonel.main');
    }

    // untuk buka halamannya
    public function create()
    {
        $provinces = Province::all();
        return view('pages.medicalPersonel.input', ['data' => new MedicalPersonel, 'provinces' => $provinces]);
    }

    public function store(Request $request)
    {
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
        MedicalPersonel::create($request->all());
        return response([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ]);
    }

    public function show(MedicalPersonel $medicalPersonel)
    {
        return view('pages.medicalPersonel.show', ['data' => $medicalPersonel]);
    }

    public function edit(MedicalPersonel $medicalPersonel)
    {
        $provinces = Province::all();
        return view('pages.medicalPersonel.input', ['data' => $medicalPersonel, 'provinces' => $provinces]);
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
        return response([
            'alert' => 'success',
            'message' => 'Data berhasil diubah',
        ]);
    }

    public function destroy(MedicalPersonel $medicalPersonel)
    {
        $medicalPersonel->delete();
        return response([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
