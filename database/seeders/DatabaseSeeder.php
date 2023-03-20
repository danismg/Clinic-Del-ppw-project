<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RegionalSeeder::class,
            MedicalPersonelSeeder::class,
            MedicineSeeder::class,
        ]);
    }
}
