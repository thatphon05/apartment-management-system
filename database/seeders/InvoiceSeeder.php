<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Invoice::count() < 1) {
            Invoice::create([
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
                'booking_id' => 1,
                'room_id' => 1,
                'status' => 0,
                'cycle' => now(),
                'util_expense_id' => 1,
                'rent_price' => 0,
                'electric_price' => 0,
                'water_price' => 0,
                'parking_price' => 0,
                'common_fee' => 0,
                'late_fines' => 0,
                'summary' => 0,
            ]);

            Invoice::create([
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 1,
                'booking_id' => 1,
                'room_id' => 1,
                'status' => 0,
                'cycle' => Carbon::now()->addMonth(),
                'util_expense_id' => 2,
                'rent_price' => 0,
                'electric_price' => 0,
                'water_price' => 0,
                'parking_price' => 0,
                'common_fee' => 0,
                'late_fines' => 0,
                'summary' => 0,
            ]);
        }

    }
}
