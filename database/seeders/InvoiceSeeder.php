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
                'util_expense_id' => 1,
                'cycle' => Carbon::create(2023),
                'status' => 0,
                'rent_total' => 2500,
                'electric_unit_last' => 10,
                'electric_unit_later' => 15,
                'electric_unit' => 5,
                'electric_unit_price' => 20,
                'electric_total' => 150,
                'water_unit_last' => 20,
                'water_unit_later' => 25,
                'water_unit' => 5,
                'water_unit_price' => 20,
                'water_total' => 300,
                'parking_total' => 300,
                'common_total' => 100,
                'overdue_total' => 0,
                'summary' => 0,
                'due_date' => Carbon::create(2023)->addMonth()->addDays(4),
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
                'rent_total' => 2500,
                'electric_unit_last' => 1950,
                'electric_unit_later' => 1957,
                'electric_unit' => 7,
                'electric_unit_price' => 10,
                'electric_total' => 70,
                'water_unit_last' => 440,
                'water_unit_later' => 442,
                'water_unit' => 2,
                'water_unit_price' => 20,
                'water_total' => 40,
                'parking_total' => 200,
                'common_total' => 200,
                'overdue_total' => 0,
                'due_date' => now()->addMonths(2)->setDays(5),
            ]);
        }

    }
}
