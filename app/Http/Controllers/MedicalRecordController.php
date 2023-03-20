<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\MedicineInOut;
use App\Models\MedicalPersonel;
use Illuminate\Support\Facades\DB;
use App\Models\PhysicalExamination;
use App\Http\Controllers\Controller;
use App\Models\MedicalRecordMedicine;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class MedicalRecordController extends Controller
{
    public function index(Request $request, Patient $patient)
    {
        if ($request->ajax()) {
            $keywords = $request->get('keywords');
            $collection = MedicalRecord::where('patient_id', $patient->id)
                ->get();
            return DataTables::of($collection)
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group" role="group">
                    <a href="javascript:;" onclick="load_detail(\'' . route('patient.medical_record.show', [$data->patient_id, $data->id]) . '\');" class="btn btn-sm btn-info">
                        <i class="fas fa-solid fa-eye"></i>
                    </a>
                    <a href="javascript:;" onclick="load_input(\'' . route('patient.medical_record.edit', [$data->patient_id, $data->id]) . '\');" class="btn btn-sm btn-warning">
                        <i class="fas fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('patient.medical_record.destroy', [$data->patient_id, $data->id]) . '\');" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>';
                })
                ->addColumn('date', function ($data) {
                    return Carbon::parse($data->created_at)->translatedFormat('d F Y');
                })
                ->rawColumns(['action', 'date'])
                ->make(true);
        }
        return view('pages.medicalRecord.main', compact('patient'));
    }

    public function create(Patient $patient)
    {
        $medical_personels = MedicalPersonel::where('profession', 'Dokter')->get();
        $medicines = Medicine::all();
        return view('pages.medicalRecord.input', ['data' => new MedicalRecord, 'patient' => $patient, 'medical_personels' => $medical_personels, 'medicines' => $medicines, 'physical_examination' => new PhysicalExamination]);
    }

    public function store(Request $request, Patient $patient)
    {
        $messages = [
            'medical_personel_id.required' => 'Pilih Dokter',
            'diagnose.required' => 'Diagnosa harus diisi',
            'diagnose.regex' => 'Diagnosa harus berupa huruf atau angka',
            'treatment.required' => 'Treatment harus diisi',
            'treatment.regex' => 'Treatment harus berupa huruf atau angka',
            'physical_examination.required' => 'Pemeriksaan Fisik harus diisi',
            'physical_examination.regex' => 'Pemeriksaan Fisik harus berupa huruf atau angka',
            'history.required' => 'Anamnesa harus diisi',
            'history.regex' => 'Anamnesa harus berupa huruf atau angka',
            'height.required' => 'Tinggi badan harus diisi',
            'weight.required' => 'Berat badan harus diisi',
            'belly_circumference.required' => 'Lingkar perut harus diisi',
            'sistole.required' => 'Sistole harus diisi',
            'diastole.required' => 'Diastole harus diisi',
            'respiratory_rate.required' => 'Nadi harus diisi',
            'heart_rate.required' => 'Frekuensi Jantung harus diisi',
            'status.required' => 'Status harus diisi',
            'kt_docs_repeater_advance.*.medicine_id.required' => 'Pilih obat',
            'kt_docs_repeater_advance.*.qty.required' => 'Jumlah harus diisi',
            'kt_docs_repeater_advance.*.procedure.required' => 'Prosedur harus diisi',
            'kt_docs_repeater_advance.*.procedure.regex' => 'Prosedur harus berupa huruf atau angka',
        ];

        $validators = Validator::make($request->all(), [
            'medical_personel_id' => 'required',
            'diagnosis' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'treatment' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'physical_examination' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'history' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'height' => 'required',
            'weight' => 'required',
            'belly_circumference' => 'required',
            'sistole' => 'required',
            'diastole' => 'required',
            'respiratory_rate' => 'required',
            'heart_rate' => 'required',
            'status' => 'required',
            'kt_docs_repeater_advance.*.medicine_id' => 'required',
            'kt_docs_repeater_advance.*.qty' => 'required',
            'kt_docs_repeater_advance.*.procedure' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
        ], $messages);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('medical_personel_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('medical_personel_id'),
                ]);
            } elseif ($errors->has('diagnosis')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('diagnosis'),
                ]);
            } elseif ($errors->has('treatment')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('treatment'),
                ]);
            } elseif ($errors->has('physical_examination')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('physical_examination'),
                ]);
            } elseif ($errors->has('history')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('history'),
                ]);
            } elseif ($errors->has('height')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('height'),
                ]);
            } elseif ($errors->has('weight')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('weight'),
                ]);
            } elseif ($errors->has('belly_circumference')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('belly_circumference'),
                ]);
            } elseif ($errors->has('sistole')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('sistole'),
                ]);
            } elseif ($errors->has('diastole')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('diastole'),
                ]);
            } elseif ($errors->has('respiratory_rate')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('respiratory_rate'),
                ]);
            } elseif ($errors->has('heart_rate')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('heart_rate'),
                ]);
            } elseif ($errors->has('status')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('status'),
                ]);
            } elseif ($errors->has('kt_docs_repeater_advance.*.medicine_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('kt_docs_repeater_advance.*.medicine_id'),
                ]);
            } elseif ($errors->has('kt_docs_repeater_advance.*.qty')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('kt_docs_repeater_advance.*.qty'),
                ]);
            } elseif ($errors->has('kt_docs_repeater_advance.*.procedure')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('kt_docs_repeater_advance.*.procedure'),
                ]);
            }
        }

        $medicalRecord = new MedicalRecord;
        $medicalRecord->patient_id = $patient->id;
        $medicalRecord->medical_personel_id = $request->medical_personel_id;
        $medicalRecord->diagnosis = $request->diagnosis;
        $medicalRecord->treatment = $request->treatment;
        $medicalRecord->physical_examination = $request->physical_examination;
        $medicalRecord->history = $request->history;
        $medicalRecord->save(); // save to database

        $physicalExamination = new PhysicalExamination;
        $physicalExamination->medical_record_id = $medicalRecord->id;
        $physicalExamination->height = $request->height;
        $physicalExamination->weight = $request->weight;
        $physicalExamination->belly_circumference = $request->belly_circumference;
        $physicalExamination->bmi = round($request->bmi, 2);
        $physicalExamination->sistole = $request->sistole;
        $physicalExamination->diastole = $request->diastole;
        $physicalExamination->respiratory_rate = $request->respiratory_rate;
        $physicalExamination->heart_rate = $request->heart_rate;
        $physicalExamination->status = $request->status;
        $physicalExamination->save(); // save to database

        $kt_docs_repeater_advance = $request->kt_docs_repeater_advanced;
        foreach ($kt_docs_repeater_advance as $key => $value) {
            $medicine = Medicine::find($value['medicine_id']);
            $medicine->quantity = $medicine->quantity - $value['qty'];
            $medicine->update(); // save to database
            $medicalRecordMedicines = new MedicalRecordMedicine;
            $medicalRecordMedicines->medical_record_id = $medicalRecord->id;
            $medicalRecordMedicines->medicine_id = $value['medicine_id'];
            $medicalRecordMedicines->quantity = $value['qty'];
            $medicalRecordMedicines->procedure = $value['procedure'];
            $medicalRecordMedicines->save(); // save to database
            $medicineInOut = new MedicineInOut();
            $medicineInOut->medicine_id = $value['medicine_id'];
            $medicineInOut->quantity_out = $value['qty'];
            $medicineInOut->quantity_remaining = $medicine->quantity;
            $medicineInOut->save(); // save to database
        }

        return response([
            'alert' => 'success',
            'message' => 'Rekam Medis berhasil ditambahkan',
        ]);
    }

    public function show(Patient $patient, MedicalRecord $medicalRecord)
    {
        return view('pages.medicalRecord.show', ['medicalRecord' => $medicalRecord]);
    }

    public function pdf(Patient $patient, MedicalRecord $medicalRecord)
    {
        $pdf = PDF::loadView('pages.medicalRecord.pdf', ['medicalRecord' => $medicalRecord]);
        return $pdf->download($medicalRecord->patient->name . '.pdf');
        // return $pdf->stream($medicalRecord->patient->name . '.pdf');
    }
    public function edit(Patient $patient, MedicalRecord $medicalRecord)
    {
        $medical_personels = MedicalPersonel::where('profession', 'Dokter')->get();
        $medicines = Medicine::all();
        $physical_examination = PhysicalExamination::where('medical_record_id', $medicalRecord->id)->first();
        return view('pages.medicalRecord.input', ['data' => $medicalRecord, 'patient' => $patient, 'medical_personels' => $medical_personels, 'medicines' => $medicines, 'physical_examination' => $physical_examination]);
    }

    public function update(Request $request, Patient $patient, MedicalRecord $medicalRecord)
    {
        $messages = [
            'medical_personel_id.required' => 'Pilih Dokter',
            'diagnose.required' => 'Diagnosa harus diisi',
            'diagnose.regex' => 'Diagnosa harus berupa huruf dan angka',
            'treatment.required' => 'Treatment harus diisi',
            'treatment.regex' => 'Treatment harus berupa huruf dan angka',
            'physical_examination.required' => 'Pemeriksaan Fisik harus diisi',
            'physical_examination.regex' => 'Pemeriksaan Fisik harus berupa huruf dan angka',
            'history.required' => 'Anamnesa harus diisi',
            'history.regex' => 'Anamnesa harus berupa huruf dan angka',
            'height.required' => 'Tinggi badan harus diisi',
            'weight.required' => 'Berat badan harus diisi',
            'belly_circumference.required' => 'Lingkar perut harus diisi',
            'sistole.required' => 'Sistole harus diisi',
            'diastole.required' => 'Diastole harus diisi',
            'respiratory_rate.required' => 'Nadi harus diisi',
            'heart_rate.required' => 'Frekuensi Jantung harus diisi',
            'status.required' => 'Status harus diisi',
            'kt_docs_repeater_advance.*.medicine_id.required' => 'Pilih obat',
            'kt_docs_repeater_advance.*.qty.required' => 'Jumlah harus diisi',
            'kt_docs_repeater_advance.*.procedure.required' => 'Prosedur harus diisi',
        ];

        $validators = Validator::make($request->all(), [
            'medical_personel_id' => 'required',
            'diagnosis' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'treatment' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'physical_examination' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'history' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
            'height' => 'required',
            'weight' => 'required',
            'belly_circumference' => 'required',
            'bmi' => 'required',
            'sistole' => 'required',
            'diastole' => 'required',
            'respiratory_rate' => 'required',
            'heart_rate' => 'required',
            'status' => 'required',
            'kt_docs_repeater_advance.*.medicine_id' => 'required',
            'kt_docs_repeater_advance.*.qty' => 'required',
            'kt_docs_repeater_advance.*.procedure' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
        ], $messages);

        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('medical_personel_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('medical_personel_id'),
                ]);
            } elseif ($errors->has('diagnosis')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('diagnosis'),
                ]);
            } elseif ($errors->has('treatment')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('treatment'),
                ]);
            } elseif ($errors->has('physical_examination')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('physical_examination'),
                ]);
            } elseif ($errors->has('history')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('history'),
                ]);
            } elseif ($errors->has('height')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('height'),
                ]);
            } elseif ($errors->has('weight')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('weight'),
                ]);
            } elseif ($errors->has('belly_circumference')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('belly_circumference'),
                ]);
            } elseif ($errors->has('sistole')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('sistole'),
                ]);
            } elseif ($errors->has('diastole')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('diastole'),
                ]);
            } elseif ($errors->has('respiratory_rate')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('respiratory_rate'),
                ]);
            } elseif ($errors->has('heart_rate')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('heart_rate'),
                ]);
            } elseif ($errors->has('status')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('status'),
                ]);
            } elseif ($errors->has('kt_docs_repeater_advance.*.medicine_id')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('kt_docs_repeater_advance.*.medicine_id'),
                ]);
            } elseif ($errors->has('kt_docs_repeater_advance.*.qty')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('kt_docs_repeater_advance.*.qty'),
                ]);
            } elseif ($errors->has('kt_docs_repeater_advance.*.procedure')) {
                return response([
                    'alert' => 'error',
                    'message' => $errors->first('kt_docs_repeater_advance.*.procedure'),
                ]);
            }
        }

        $medicalRecord->patient_id = $patient->id;
        $medicalRecord->medical_personel_id = $request->medical_personel_id;
        $medicalRecord->diagnosis = $request->diagnosis;
        $medicalRecord->treatment = $request->treatment;
        $medicalRecord->physical_examination = $request->physical_examination;
        $medicalRecord->history = $request->history;
        $medicalRecord->update();

        $physical_examination = $medicalRecord->physicalExamination;
        $physical_examination->height = $request->height;
        $physical_examination->weight = $request->weight;
        $physical_examination->belly_circumference = $request->belly_circumference;
        $physical_examination->bmi = round($request->bmi, 2);
        $physical_examination->sistole = $request->sistole;
        $physical_examination->diastole = $request->diastole;
        $physical_examination->respiratory_rate = $request->respiratory_rate;
        $physical_examination->heart_rate = $request->heart_rate;
        $physical_examination->status = $request->status;
        $physical_examination->update();

        Helper::resetMedicine($medicalRecord->id);
        $medicalRecordMedicines = $request->kt_docs_repeater_advanced;

        $medicalRecordMedicinesOld = $medicalRecord->medicines();
        foreach ($medicalRecordMedicinesOld as $key => $value) {
            $medicine = MedicalRecordMedicine::where('medical_record_id', $medicalRecord->id)->where('medicine_id', $value->medicine_id)->first();
            $medicine->delete();
        }

        foreach ($medicalRecordMedicines as $key => $value) {
            $medicine = Medicine::find($value['medicine_id']);
            $medicine->quantity = $medicine->quantity - $value['qty'];
            $medicalRecordMedicineNew = new MedicalRecordMedicine;
            $medicalRecordMedicineNew->medical_record_id = $medicalRecord->id;
            $medicalRecordMedicineNew->medicine_id = $value['medicine_id'];
            $medicalRecordMedicineNew->quantity = $value['qty'];
            $medicalRecordMedicineNew->procedure = $value['procedure'];
            $medicalRecordMedicineNew->save();
            $medicineInOut = new MedicineInOut;
            $medicineInOut->medicine_id = $value['medicine_id'];
            $medicineInOut->quantity_out = $value['qty'];
            $medicineInOut->quantity_remaining = $medicine->quantity;
            $medicineInOut->save();
            $medicine->update();
        }

        return response([
            'alert' => 'success',
            'message' => 'Rekam Medis berhasil diperbarui',
        ]);
    }

    public function destroy(Patient $patient, MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return response([
            'alert' => 'success',
            'message' => 'Rekam Medis berhasil dihapus',
        ]);
    }
}
