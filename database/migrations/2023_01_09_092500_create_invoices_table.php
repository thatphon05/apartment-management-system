<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration
{

    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('booking_id')->unsigned();
            $table->integer('status');
            $table->date('cycle');
            $table->integer('util_expense_id')->unsigned();
            $table->decimal('rent_price');
            $table->decimal('electric_price');
            $table->decimal('water_price');
            $table->decimal('parking_price');
            $table->decimal('common_fee');
            $table->decimal('damages_price')->default('0');
            $table->decimal('summary')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('invoices');
    }
}
