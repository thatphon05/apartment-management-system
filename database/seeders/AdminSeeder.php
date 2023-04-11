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
                'email' => 'admin@topaz-apart.ddns.net',
                'password' => '123',
                'name' => 'Admin Topaz',
                'status' => 1,
            ]);
        }
    }
}
