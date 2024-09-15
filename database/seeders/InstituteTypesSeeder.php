<?php

namespace Database\Seeders;

use App\Models\InstituteTypes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstituteTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instituteTypes = [
            ['institute_type' => 'Private Bank'],
            ['institute_type' => 'Cooperative Bank'],
            ['institute_type' => 'Pharmacy'],
            ['institute_type' => 'Hotel'],
            ['institute_type' => 'Farm House'],
            ['institute_type' => 'Hardware Shop'],
            ['institute_type' => 'Training Institutes'],
            ['institute_type' => 'Restaurants'],
            ['institute_type' => 'Clothing Shop'],
            ['institute_type' => 'Computer Shop'],
            ['institute_type' => 'Super Market'],
            ['institute_type' => 'Factories'],
            ['institute_type' => 'Chemical Shop'],
            ['institute_type' => 'Bakery Shop'],
            //Add more institute types.......
        ];

        foreach ($instituteTypes as $type) {
            InstituteTypes::create($type);
        }
    }
}
