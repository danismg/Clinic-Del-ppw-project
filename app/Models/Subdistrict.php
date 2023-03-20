<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function cities()
    {
        return $this->belongsTo(City::class);
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
