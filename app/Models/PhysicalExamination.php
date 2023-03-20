<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
    use HasFactory;

    public function medical_record()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
