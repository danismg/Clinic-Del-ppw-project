<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionalController extends Controller
{
    public function province(Request $request)
    {
        $result = Province::get();
        $list = "<option>Pilih Propinsi</option>";
        foreach($result as $row){
            $list.="<option value='$row->id'>$row->name</option>";
        }
        echo $list;
    }
    public function city(Request $request)
    {
        $result = City::where('province_id','=',$request->province)->get();
        $list = "<option>Pilih Kota</option>";
        foreach($result as $row){
            $list.="<option value='$row->id'>$row->name</option>";
        }
        echo $list;
    }
    public function subdistrict(Request $request)
    {
        $result = Subdistrict::where('city_id','=',$request->city)->get();
        $list = "<option>Pilih Kecamatan</option>";
        foreach($result as $row){
            $list.="<option value='$row->id'>$row->name</option>";
        }
        echo $list;
    }
}
