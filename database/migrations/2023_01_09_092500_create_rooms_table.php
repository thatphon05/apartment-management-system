<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration
{

    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('floor_id')->unsigned();
            $table->integer('building_id')->unsigned();
            $table->integer('configuration_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('rooms');
    }
}
