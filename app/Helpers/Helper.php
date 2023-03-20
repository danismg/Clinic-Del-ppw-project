<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Medicine;

use App\Models\MedicineInOut;
use Illuminate\Support\Facades\DB;
use App\Models\MedicalRecordMedicine;

class Helper
{
    public static function age($date_of_birth)
    {
        $date_of_birth = Carbon::parse($date_of_birth);
        $now = Carbon::now();
        $age = $now->diffInYears($date_of_birth);
        return $age;
    }

    public static function datebirth($age)
    {
        if (is_numeric($age)) {
            $date_of_birth = Carbon::now()->subYears($age + 1)->format('Y-m');
            return $date_of_birth;
        } else {
            return null;
        }
    }
    public static function checkLatest($medicine_id)
    {
        $latest = MedicineInOut::whereYear('created_at', Carbon::now()->year)
            ->where('medicine_id', $medicine_id)
            ->select(DB::raw('MONTH(created_at) as month'))
            ->distinct()
            ->first();
        if ($latest) {
            return $latest->month;
        } else {
            return false;
        }
        return $latest;
    }

    public static function getMedicineData($date)
    {
        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;
        $quantity = MedicineInOut::join('medicines', 'medicines.id', '=', 'medicine_in_outs.medicine_id')
            ->whereYear('medicine_in_outs.created_at', $year)
            ->whereMonth('medicine_in_outs.created_at', $month)
            ->select(
                DB::raw('medicines.id as id, medicines.name'),
                DB::raw('SUM(medicine_in_outs.quantity_in) as quantity_in'),
                DB::raw('SUM(medicine_in_outs.quantity_out) as quantity_out'),
                DB::raw('medicines.quantity as quantity_remaining')
            )
            ->groupBy('medicine_id')
            ->orderBy('medicine_id')
            ->get();
        return $quantity;
    }

    public static function getMedicineRemainingLastMonth($medicine_id, $date)
    {
        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;
        if ($month != Helper::checkLatest($medicine_id)) {
            $quantity = MedicineInOut::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('medicine_id', $medicine_id)
                ->select('quantity_remaining')
                ->latest()
                ->first();
            return $quantity;
        } else {
            return 0;
        }
    }

    public static function getMedicineUsage($medicine_id)
    {
        $quantity = MedicineInOut::where('medicine_id', $medicine_id)
            ->select(DB::raw('SUM(quantity_out) as quantity_out'))
            ->first();
        return $quantity['quantity_out'];
    }

    public static function resetMedicine($medical_record_id)
    {
        $all_medical_record_medicine = MedicalRecordMedicine::where('medical_record_id', $medical_record_id)->get();
        foreach ($all_medical_record_medicine as $medical_record_medicine) {
            $medicine_in_out = MedicineInOut::where('medicine_id', $medical_record_medicine->medicine_id)->where('created_at', '=', $medical_record_medicine->created_at)->first();
            $medicine_in_out->delete();
            $medicine = Medicine::find($medical_record_medicine->medicine_id);
            $medicine->quantity = $medicine->quantity + $medical_record_medicine->quantity;
            $medicine->update();
            $medical_record_medicine->delete();
        }
    }
}
