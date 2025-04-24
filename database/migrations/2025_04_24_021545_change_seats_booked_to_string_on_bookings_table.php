<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        // change from integer to text (you can use string() for VARCHAR)
        $table->text('seats_booked')->change();
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        // back to integer if you really need it (but storing as int won’t work for codes)
        $table->integer('seats_booked')->change();
    });
}

};
