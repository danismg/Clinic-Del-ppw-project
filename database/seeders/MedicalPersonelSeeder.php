<?php

namespace Database\Seeders;

use App\Models\MedicalPersonel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicalPersonelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medical_personel = array(
            [
                'name' => 'dr. Togumanata Naipospos',
                'identity_number' => '1212022307930001',
                'profession' => 'Dokter',
                'position' => 'Dokter Klinik',
                'education' => 'Sarjana Kedokteran',
                'address' => 'Balige',
                'province_id' => '34',
                'city_id' => '481',
                'subdistrict_id' => '6653',
                'phone_number' => '085372053344',
                'email' => 'togu.naipospos@del.ac.id',
            ],
            [
                'name' => 'Eva Viviana Pasaribu',
                'identity_number' => '1212114601900002',
                'profession' => 'Perawat',
                'position' => 'Perawat Klinik',
                'education' => 'D-III Keperawatan',
                'address' => 'Balige',
                'province_id' => '34',
                'city_id' => '481',
                'subdistrict_id' => '6653',
                'phone_number' => '085207942500',
                'email' => 'eva.pasaribu@del.ac.id',
            ],
            [
                'name' => 'Karolina Sitorus',
                'identity_number' => '1212074401990002',
                'profession' => 'Bidan',
                'position' => 'Bidan Klinik',
                'education' => 'D-III Kebidanan',
                'address' => 'Balige',
                'province_id' => '34',
                'city_id' => '481',
                'subdistrict_id' => '6653',
                'phone_number' => '082165694843',
                'email' => 'karolina.sitorus@del.ac.id',
            ]
        );
        foreach ($medical_personel as $med) {
            MedicalPersonel::create($med);
        }
    }
}
