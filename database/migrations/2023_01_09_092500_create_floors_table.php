<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFloorsTable extends Migration
{

    public function up(): void
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name');
            $table->integer('building_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('floors');
    }
}
