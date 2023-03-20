<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\Helper;
use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.dashboard.main');
    }

    public function getPatient(Request $request)
    {
        return DataTables::of(Patient::query())
            ->addColumn('age', function ($patient) {
                return Carbon::parse($patient->birth_date)->age;
            })
            ->make(true);
    }

    public function getMedicine(Request $request)
    {
        $medicines = Medicine::join('medicine_in_outs', 'medicine_in_outs.medicine_id', '=', 'medicines.id')
            ->selectRaw('medicines.*, sum(medicine_in_outs.quantity_out) as quantity_out')
            ->where('medicine_in_outs.created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('medicines.id')
            ->get();
        return DataTables::of($medicines)
            ->addColumn('usage', function ($medicine) {
                return $medicine->quantity_out;
            })
            ->make(true);
    }
}
