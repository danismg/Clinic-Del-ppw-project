<?php

namespace App\Models;

use App\Models\City;
use App\Models\Patient;
use App\Models\MedicalPersonel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
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
