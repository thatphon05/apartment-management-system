<?php

namespace Database\Seeders;

use App\Models\Repair;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Repair::count() < 1) {
            Repair::create([
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
                'room_id' => 1,
                'booking_id' => 1,
                'subject' => 'หลอดไฟเสีย',
                'description' => 'หลอดไฟหน้าห้องเสีย',
                'status' => 0,
            ]);
        }

    }
}
