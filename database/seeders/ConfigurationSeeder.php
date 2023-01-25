<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Configuration::count() < 1) {
            Configuration::create([
                'created_at' => now(),
                'updated_at' => now(),
                'rent_price' => 2500,
                'electric_price' => 5,
                'water_price' => 10,
                'parking_price' => 300,
                'common_fee' => 200,
                'damages_price' => 50,
                'deposit' => 5000,
            ]);
        }
    }
}
