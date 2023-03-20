<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medical_personel()
    {
        return $this->belongsTo(MedicalPersonel::class);
    }

    public function medicines()
    {
        return $this->hasMany(MedicalRecordMedicine::class);
    }

    public function physicalExamination()
    {
        return $this->hasOne(PhysicalExamination::class);
    }
}
