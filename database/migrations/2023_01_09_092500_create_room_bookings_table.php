<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomBookingsTable extends Migration
{

    public function up(): void
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->string('rental_contract');
            $table->date('arrival_date');
            $table->decimal('deposit');
            $table->tinyInteger('status');
            $table->integer('parking_amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('room_bookings');
    }
}
