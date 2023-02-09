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
                'name' => 'ทั่วไป',
                'rent_fee' => 2500,
                'electric_fee' => 5,
                'water_fee' => 10,
                'parking_fee' => 300,
                'common_fee' => 200,
                'overdue_fee' => 50,
                'deposit' => 5000,
            ]);
        }
    }
}
