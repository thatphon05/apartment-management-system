<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration
{

    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('rent_price');
            $table->decimal('electric_price');
            $table->decimal('water_price');
            $table->decimal('parking_price');
            $table->decimal('common_fee');
            $table->decimal('damages_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('configurations');
    }
}
