<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilitiesExpensesTable extends Migration
{

    public function up()
    {
        Schema::create('utilities_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('electric_unit');
            $table->integer('water_unit');
            $table->integer('booking_id')->unsigned();
            $table->integer('month');
            $table->date('note_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('utilities_expenses');
    }
}
