<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,

            BuildingSeeder::class,
            FloorSeeder::class,
            RoomSeeder::class,

            ConfigurationSeeder::class,

            RoomBookingSeeder::class,
            UtilityExpenseSeeder::class,
            InvoiceSeeder::class,
            PaymentSeeder::class,

            RepairSeeder::class,
        ]);
    }
}
