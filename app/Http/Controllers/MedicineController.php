<?php

namespace App\Http\Controllers;


use Excel;
use App\Helpers\Helper;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineInOut;
use App\Exports\MedicineExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PDF;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Medicine::all())
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="id[]" value="' . $data->id . '">';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group" role="group">
                    <a href="javascript:;"onclick="handle_open_modal(\'' . route('medicine.input_modal', $data->id) . '\',\'#modalListResult\',\'#contentListResult\');" class="btn btn-sm btn-primary">
                        <i class="fas fa-solid fa-add"></i>
                    </a>
                    <a href="javascript:;" onclick="load_input(\'' . route('medicine.edit', $data->id) . '\');" class="btn btn-sm btn-warning">
                        <i class="fas fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('medicine.destroy', $data->id) . '\');" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('pages.medicine.main');
    }

    public function create()
    {
        return view('pages.medicine.input', ['data' => new Medicine]);
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
            'alert' => 'success',
            'message' => 'Data ' . $request->title . ' tersimpan',
        ]);
    }

    public function show(Medicine $medicine)
    {
        //
    }

    public function input_modal(Medicine $medicine)
    {
        return view('pages.medicine.input_modal', ['data' => $medicine]);
    }
    public function input_export_pdf()
    {
        $medicine = MedicineInOut::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year')
            ->distinct()
            ->get();
        return view('pages.medicine.input_export_pdf', ['data' => $medicine]);
    }
    public function input_export_excel()
    {
        $medicine = MedicineInOut::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year')
            ->distinct()
            ->get();
        return view('pages.medicine.input_export_excel', ['data' => $medicine]);
    }

    public function update_modal(Request $request, Medicine $medicine)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('quantity')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Jumlah Obat harus diisi',
                ]);
            }
        }
        $medicine->quantity = $medicine->quantity + $request->quantity;
        $medicine->update();

        $medicine_in_out = new MedicineInOut;
        $medicine_in_out->medicine_id = $medicine->id;
        $medicine_in_out->quantity_in = $request->quantity;
        $medicine_in_out->quantity_remaining = $medicine->quantity;
        $medicine_in_out->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data ' . $request->title . ' tersimpan',
        ]);
    }

    public function pdf(Request $request)
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
        $medicines = Helper::getMedicineData($request->get('date'));
        $date = $request->get('date');
        $pdf = PDF::loadView('pages.medicine.pdf', compact('medicines', 'date'));
        return $pdf->download(date('Y-m-d') . '.pdf');
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

        $fileName = date('Y-m-d') . '.xlsx';
        return Excel::download(new MedicineExport($request->date), $fileName);
    }
    public function edit(Medicine $medicine)
    {
        return view('pages.medicine.input', ['data' => $medicine]);
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
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
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
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
