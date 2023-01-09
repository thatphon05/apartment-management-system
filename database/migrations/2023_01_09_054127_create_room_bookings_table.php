<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomBookingsTable extends Migration
{

    public function up()
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->string('rent_contract');
            $table->datetime('contract_start');
            $table->datetime('contract_end');
            $table->decimal('deposit');
            $table->integer('status')->unsigned();
            $table->integer('parking_amount')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('room_bookings');
    }
}
