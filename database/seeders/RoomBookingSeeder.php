<?php

namespace Database\Seeders;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoomBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Booking::count() < 1) {
            Booking::create(array(
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
                'room_id' => 1,
                'rent_contract' => '/',
                'contract_start' => Carbon::now(),
                'contract_end' => Carbon::now()->addMonth(6),
                'deposit' => 2000,
                'status' => 1,
                'parking_amount' => 1
            ));
        }
    }
}
