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
                'rent_total' => 0,
                'electric_total' => 0,
                'water_total' => 0,
                'parking_total' => 0,
                'common_total' => 0,
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
                'rent_total' => 0,
                'electric_total' => 0,
                'water_total' => 0,
                'parking_total' => 0,
                'common_total' => 0,
                'overdue_total' => 0,
                'summary' => 0,
                'due_date' => now()->addMonths(2)->setDays(5),
            ]);
        }

    }
}
