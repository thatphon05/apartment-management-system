<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
