<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('telephone', 10);
            $table->string('password');
            $table->string('id_card_number', 13);
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->string('religion');
            $table->string('address');
            $table->string('subdistrict');
            $table->string('district');
            $table->string('province');
            $table->string('postal_code', 5);
            $table->string('id_card_copy');
            $table->string('copy_house_registration');
            $table->tinyInteger('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('users');
    }
}
