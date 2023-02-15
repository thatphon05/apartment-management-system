<?php

namespace Database\Seeders;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoomBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Booking::count() < 1) {
            Booking::create(array(
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
                'room_id' => 1,
                'rental_contract' => 'test.pdf',
                'arrival_date' => Carbon::now()->addMonth(1),
                'deposit' => 5000,
                'status' => 1,
                'parking_amount' => 1
            ));
        }
    }
}
