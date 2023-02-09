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
            $table->integer('room_id')->unsigned();
            $table->integer('util_expense_id')->unsigned();
            $table->tinyInteger('status');
            $table->date('cycle');
            $table->decimal('rent_total')->default(0);
            $table->decimal('electric_total')->default(0);
            $table->decimal('water_total')->default(0);
            $table->decimal('parking_total')->default(0);
            $table->decimal('common_total')->default(0);
            $table->decimal('overdue_total')->default(0);
            $table->decimal('summary')->default(0);
            $table->date('due_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('invoices');
    }
}
