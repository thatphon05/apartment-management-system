<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            DB::table('floors')->insert([
                'created_at' => now(),
                'updated_at' => now(),
                'name' => $i,
                'building_id' => 1,
            ]);
        }
    }
}
