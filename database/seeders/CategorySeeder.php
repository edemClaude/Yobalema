<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'A1' => 'Motocyclette',
            'A' => 'Moto',
            'B' => 'Véhicule Légère',
            'C' => 'Camion',
            'D' => 'Bus',
            'E' => 'Long Véhicule',
            'F' => 'Véhicule Spéciale',
        ];

        foreach ($categories as $key => $value) {
            DB::table('categories')->insertGetId([
                'name' => $value,
                'type_permis' => $key,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
