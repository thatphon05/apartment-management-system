<?php

namespace Database\Seeders;

use App\Models\Floor;
use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Floor::count() < 1) {
            for ($i = 1; $i <= 4; $i++) {
                Floor::create([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'name' => $i,
                    'building_id' => 1,
                ]);
            }
        }
    }
}
