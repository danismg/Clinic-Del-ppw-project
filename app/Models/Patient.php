<?php

namespace App\Models;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identity_number',
        'birth_date',
        'address',
        'province_id',
        'city_id',
        'subdistrict_id',
        'bpjs_number',
        'gender',
        'status',
    ];

    public function medical_records()
    {
        return $this->hasmany(MedicalRecord::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
