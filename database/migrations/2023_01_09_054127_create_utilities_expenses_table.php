<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilitiesExpensesTable extends Migration
{

    public function up()
    {
        Schema::create('utilities_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('electric');
            $table->integer('water');
            $table->integer('booking_id')->unsigned();
            $table->date('date_of_note');
            $table->integer('month');
        });
    }

    public function down()
    {
        Schema::drop('utilities_expenses');
    }
}
