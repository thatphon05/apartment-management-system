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
        // User account
        if (User::count() < 1) {
            User::create(array(
                'email' => 'test@user.com',
                'telephone' => '0123456789',
                'password' => '123',
                'id_card_number' => '1352464874125',
                'name' => 'ภพธร',
                'surname' => 'มกรธวัช',
                'birthdate' => now(),
                'religion' => 'พุทธ',
                'address' => '252/561 หมู่ 50',
                'subdistrict' => 'บ้านดิว',
                'district' => 'เมือง',
                'province' => 'สมุทรสงกรานต์',
                'postal_code' => '66666',
                'id_card_copy' => 'test.pdf',
                'copy_house_registration' => 'test.php',
                'status' => 1,
            ));
        }

    }
}
