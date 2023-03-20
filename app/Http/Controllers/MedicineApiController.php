<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineInOut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MedicineApiController extends Controller
{
    public function index()
    {
        $medicine = Medicine::all();
        return response()->json([
            'message' => 'Berhasil nampilin medicalRecord',
            'medicine' => $medicine
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama Obat harus diisi',
            'name.regex' => 'Nama Obat harus berupa huruf atau angka',
            'name.unique' => 'Nama Obat sudah ada',
            'type.required' => 'Jenis Obat harus diisi',
            'quantity.required' => 'Jumlah Obat harus diisi',
            'category.required' => 'Kategori Obat harus diisi',
        ];

        $validators = Validator::make($request->all(), [
            'name' => 'required|unique:medicines|regex:/^[a-zA-Z0-9\s]+$/',
            'type' => 'required',
            'quantity' => 'required',
            'category' => 'required',
        ], $messages);


        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            } elseif ($errors->has('type')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('type'),
                ]);
            } elseif ($errors->has('quantity')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('quantity'),
                ]);
            } elseif ($errors->has('category')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('category'),
                ]);
            }
        }

        $medicine = Medicine::create($request->all());

        $medicine_in_out = new MedicineInOut;
        $medicine_in_out->medicine_id = $medicine->id;
        $medicine_in_out->quantity_in = $request->quantity;
        $medicine_in_out->quantity_remaining = $medicine->quantity;
        $medicine_in_out->save();

        return response()->json([
            'message' => 'Berhasil nambah medicine',
            'medicine' => $medicine
        ], 201);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Medicine $medicine)
    {
        $messages = [
            'name.required' => 'Nama Obat harus diisi',
            'name.regex' => 'Nama Obat harus berupa huruf atau angka',
            'name.unique' => 'Nama Obat sudah ada',
            'type.required' => 'Jenis Obat harus diisi',
            'quantity.required' => 'Jumlah Obat harus diisi',
            'category.required' => 'Kategori Obat harus diisi',
            'category.regex' => 'Kategori Obat harus berupa huruf atau angka',
        ];

        $validators = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|unique:medicines,name,' . $medicine->id,
            'type' => 'required',
            'quantity' => 'required',
            'category' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
        ], $messages);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            } elseif ($errors->has('type')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('type'),
                ]);
            } elseif ($errors->has('quantity')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('quantity'),
                ]);
            } elseif ($errors->has('category')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('category'),
                ]);
            }
        }

        $medicine->update($request->all());

        $medicine_in_out = MedicineInOut::where('medicine_id', $medicine->id)->latest()->first();
        $medicine_in_out->medicine_id = $medicine->id;
        $medicine_in_out->quantity_in = $request->quantity - $medicine->quantity;
        $medicine_in_out->quantity_remaining = $medicine->quantity;
        $medicine_in_out->save();
        return response()->json([
            'message' => 'Berhasil update medicine',
            'medicine' => $medicine
        ], 201);
    }

    public function destroy($id)
    {
        $medicine = Medicine::where('id', $id)->delete();
        return response()->json([
            'message' => 'Berhasil hapus medicine',
            'medicine' => $medicine
        ], 200);
    }

    public function delete_all(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('ids')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Pilih data yang akan dihapus',
                ]);
            }
        }
        $ids = $request->ids;
        $medicines = Medicine::whereIn('id', $ids)->get();
        foreach ($medicines as $medicine) {
            $medicine->delete();
        }
        return response()->json([
            'message' => 'Data berhasil dihapus',
            'medicine' => $medicine
        ]);
    }
}
