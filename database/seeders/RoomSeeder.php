<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Room::count() < 1) {
            $count = 1;
            for ($i = 1; $i <= 40; $i++) {
                Room::create([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'name' => $i,
                    'floor_id' => $count,
                    'building_id' => 1,
                    'configuration_id' => 1,
                ]);

                if ($i % 10 == 0) {
                    $count += 1;
                }
            }
        }
    }
}
