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
    Schema::create('buses', function (Blueprint $table) {
        $table->id();
        $table->string('bus_name');
        $table->string('from_location');
        $table->string('to_location');
        $table->date('departure_date');
        $table->integer('available_seats');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
