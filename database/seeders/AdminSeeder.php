<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin account
        if (Admin::count() < 1) {
            Admin::create([
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'thatphon.t@ku.th',
                'password' => '123',
                'name' => 'Thatpon',
                'status' => 1,
            ]);
            Admin::create([
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'tanawit.w@ku.th',
                'password' => '123',
                'name' => 'Tanawit',
                'status' => 1,
            ]);
        }
    }
}
