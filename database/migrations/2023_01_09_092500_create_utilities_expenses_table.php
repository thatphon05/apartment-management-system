<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUtilitiesExpensesTable extends Migration
{
    public function up(): void
    {
        Schema::create('utilities_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('water_unit');
            $table->integer('electric_unit');
            $table->integer('water_consumed');
            $table->integer('electric_consumed');
            $table->integer('room_id')->unsigned();
            $table->date('cycle');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('utilities_expenses');
    }
}
