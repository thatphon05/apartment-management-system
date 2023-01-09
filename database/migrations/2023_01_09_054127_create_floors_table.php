<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFloorsTable extends Migration
{

    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('name');
            $table->integer('building_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('floors');
    }
}
