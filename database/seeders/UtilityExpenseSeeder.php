<?php

namespace Database\Seeders;

use App\Models\UtilityExpense;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UtilityExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (UtilityExpense::count() < 1) {
            UtilityExpense::create([
                'created_at' => now(),
                'updated_at' => now(),
                'electric_unit' => 5,
                'water_unit' => 5,
                'booking_id' => 1,
                'room_id' => 1,
                'cycle' => now(),
                'note_date' => now(),
            ]);

            UtilityExpense::create([
                'created_at' => now(),
                'updated_at' => now(),
                'electric_unit' => 10,
                'water_unit' => 10,
                'booking_id' => 1,
                'room_id' => 1,
                'cycle' => Carbon::now()->addMonth(),
                'note_date' => Carbon::now()->addMonth(),
            ]);
        }

    }
}
