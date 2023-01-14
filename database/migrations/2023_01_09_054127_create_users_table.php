<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('password');
            $table->string('id_card');
            $table->string('name');
            $table->string('surname');
            $table->datetime('birthdate');
            $table->string('religion');
            $table->string('address');
            $table->string('sub_district');
            $table->string('district');
            $table->string('province');
            $table->string('postal_code');
            $table->string('id_card_copy');
            $table->string('copy_house_registration');
            $table->boolean('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
