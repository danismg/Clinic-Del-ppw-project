<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'category',
    ];

    public function medicine_in_out()
    {
        return $this->hasMany(MedicineInOut::class);
    }

    public function medicine_in_out_in()
    {
        return $this->hasMany(MedicineInOut::class)->where('quantity_in', '>', 0);
    }

    public function medicine_in_out_out()
    {
        return $this->hasMany(MedicineInOut::class)->where('quantity_out', '>', 0);
    }

    public function medicine_in_out_remaining()
    {
        return $this->hasMany(MedicineInOut::class)->where('quantity_remaining', '>', 0);
    }

    public function medicine_in_out_in_sum()
    {
        return $this->hasMany(MedicineInOut::class)->where('quantity_in', '>', 0)->sum('quantity_in');
    }

    public function medicine_in_out_out_sum()
    {
        return $this->hasMany(MedicineInOut::class)->where('quantity_out', '>', 0)->sum('quantity_out');
    }

    public function medicine_in_out_remaining_sum()
    {
        return $this->hasMany(MedicineInOut::class)->where('quantity_remaining', '>', 0)->sum('quantity_remaining');
    }

    public function medical_record()
    {
        return $this->hasMany(MedicalRecordMedicine::class);
    }
}
