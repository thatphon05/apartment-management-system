<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{

    public function up()
    {
        Schema::table('floors', function (Blueprint $table) {
            $table->foreign('building_id')->references('id')->on('buildings')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('rooms', function (Blueprint $table) {
            $table->foreign('building_id')->references('id')->on('buildings')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('rooms', function (Blueprint $table) {
            $table->foreign('configuration_id')->references('id')->on('configurations')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('rooms', function (Blueprint $table) {
            $table->foreign('floor_id')->references('id')->on('floors')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('room_bookings')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('room_bookings')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('util_expense_id')->references('id')->on('utilities_expenses')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('utilities_expenses', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('booking_id')->references('id')->on('room_bookings')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('invoice_id')->references('id')->on('invoices')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    public function down()
    {
        Schema::table('floors', function (Blueprint $table) {
            $table->dropForeign('floors_building_id_foreign');
        });
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign('rooms_floor_id_foreign');
        });
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->dropForeign('room_bookings_user_id_foreign');
        });
        Schema::table('room_bookings', function (Blueprint $table) {
            $table->dropForeign('room_bookings_room_id_foreign');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign('repairs_booking_id_foreign');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign('repairs_user_id_foreign');
        });
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropForeign('repairs_room_id_foreign');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_user_id_foreign');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_booking_id_foreign');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_room_id_foreign');
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('invoices_util_expense_id_foreign');
        });
        Schema::table('utilities_expenses', function (Blueprint $table) {
            $table->dropForeign('utilities_expenses_room_id_foreign');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_user_id_foreign');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_booking_id_foreign');
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_invoice_id_foreign');
        });
    }
}
