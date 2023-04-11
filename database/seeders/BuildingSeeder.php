<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Building::count() < 1) {
            Building::create([
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 1,
            ]);
        }
    }
}
