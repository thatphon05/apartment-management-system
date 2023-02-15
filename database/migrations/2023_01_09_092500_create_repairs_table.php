<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepairsTable extends Migration
{

    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->string('subject');
            $table->longText('description');
            $table->longText('note')->nullable();
            $table->dateTime('repair_date')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('repairs');
    }
}
