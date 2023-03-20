<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalPersonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identity_number',
        'profession',
        'position',
        'education',
        'address',
        'province_id',
        'city_id',
        'subdistrict_id',
        'phone_number',
        'email',
    ];

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
    public function medical_record()
    {
        return $this->hasMany(Patient::class);
    }
}
