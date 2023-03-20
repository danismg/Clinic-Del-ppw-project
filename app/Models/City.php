<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function provinces()
    {
        return $this->belongsTo(Province::class);
    }

    public function subdistricts()
    {
        return $this->hasMany(Subdistrict::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function medical_personel()
    {
        return $this->hasMany(MedicalPersonel::class);
    }
}
