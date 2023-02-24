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
            for ($i = 1; $i <= 40; $i++)
                UtilityExpense::create([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'electric_unit' => 0,
                    'water_unit' => 0,
                    'room_id' => $i,
                    'cycle' => Carbon::createFromDate(2022, 12, 01),
                ]);
        }

    }
}
