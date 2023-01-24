<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepairsTable extends Migration
{

    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->string('subject');
            $table->longText('description');
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('repairs');
    }
}
