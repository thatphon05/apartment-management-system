<?php

namespace Database\Seeders;

use App\Models\UtilityExpense;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UtilityExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (UtilityExpense::count() < 1) {
            UtilityExpense::create([
                'created_at' => now(),
                'updated_at' => now(),
                'electric_unit' => 5,
                'water_unit' => 5,
                'room_id' => 1,
                'cycle' => now(),
            ]);

            UtilityExpense::create([
                'created_at' => now(),
                'updated_at' => now(),
                'electric_unit' => 10,
                'water_unit' => 10,
                'room_id' => 1,
                'cycle' => Carbon::now()->addMonth(),
            ]);
        }

    }
}
