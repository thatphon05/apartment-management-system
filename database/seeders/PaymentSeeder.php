<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Room::count() < 1) {
            Room::create([
                'created_at' => now(),
                'updated_at' => now(),
                'attachfile' => 'test.pdf',
                'user_id' => 1,
                'booking_id' => 1,
                'invoice_id' => 2,
                'status' => 1,
            ]);
        }
    }
}
