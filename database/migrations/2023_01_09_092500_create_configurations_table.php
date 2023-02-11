<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration
{

    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('rent_fee');
            $table->decimal('electric_fee');
            $table->decimal('water_fee');
            $table->decimal('parking_fee');
            $table->decimal('common_fee');
            $table->decimal('overdue_fee');
            $table->decimal('deposit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('configurations');
    }
}
