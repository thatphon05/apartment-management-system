<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin account
        if (User::where('role', '=', 'admin')->count() < 1) {
            User::create([
                'created_at' => now(),
                'updated_at' => now(),
                'email' => 'thatphon.t@ku.th',
                'id_card' => '1352464874125',
                'telephone' => '0985098059',
                'password' => bcrypt('123'),
                'name' => 'User',
                'surname' => 'Number 1',
                'birthdate' => now(),
                'religion' => 'เจได',
                'address' => '252/561 หมู่ 50',
                'sub_district' => 'บ้านดิว',
                'district' => 'เมือง',
                'province' => 'สมุทรสงกรานต์',
                'postal_code' => '66666',
                'id_card_copy' => '/',
                'copy_house_registration' => '/',
                'active' => 1,
                'role' => 'admin'
            ]);
        }

        // User account
        if (User::where('role', '=', 'user')->count() < 1) {
            User::create(array(
                'email' => 'test@user.com',
                'telephone' => '0985098059',
                'password' => bcrypt('123'),
                'id_card' => '1352464874125',
                'name' => 'User',
                'surname' => 'Number 1',
                'birthdate' => now(),
                'religion' => 'เจได',
                'address' => '252/561 หมู่ 50',
                'sub_district' => 'บ้านดิว',
                'district' => 'เมือง',
                'province' => 'สมุทรสงกรานต์',
                'postal_code' => '66666',
                'id_card_copy' => '/',
                'copy_house_registration' => '/',
                'active' => 1,
                'role' => 'user'
            ));
        }

    }
}
