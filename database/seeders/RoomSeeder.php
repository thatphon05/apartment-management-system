<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Room::count() < 1) {
            $count = 1;
            for ($i = 1; $i <= 40; $i++) {
                Room::create([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'name' => $i,
                    'floor_id' => $count,
                    'rent_price' => 2500,
                    'electric_price' => 5,
                    'water_price' => 10,
                    'parking_price' => 300,
                    'common_fee' => 200,
                ]);

                if ($i % 10 == 0) {
                    $count += 1;
                }
            }
        }
    }
}
