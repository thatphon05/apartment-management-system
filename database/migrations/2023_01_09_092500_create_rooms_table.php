<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration
{

    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('floor_id')->unsigned();
            $table->decimal('rent_price');
            $table->decimal('electric_price');
            $table->decimal('water_price');
            $table->decimal('parking_price');
            $table->decimal('common_fee');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('rooms');
    }
}
