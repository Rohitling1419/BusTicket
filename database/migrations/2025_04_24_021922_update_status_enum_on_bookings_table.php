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
        // list every allowed status here
        $table->enum('status', ['pending','confirmed','cancelled','refunded'])
              ->default('pending')
              ->change();
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        // rollback to whatever your old enum was
        $table->enum('status', ['pending','cancelled'])->default('pending')->change();
    });
}

};
