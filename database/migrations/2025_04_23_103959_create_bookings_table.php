<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/YYYY_MM_DD_create_bookings_table.php
public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('bus_id')->constrained()->onDelete('cascade');
        $table->string('seat_number');
        $table->date('booking_date');
        $table->enum('status', ['pending', 'confirmed', 'cancelled']);
        $table->timestamps();
    });
    
}

public function down()
{
    Schema::dropIfExists('bookings');
}

};
