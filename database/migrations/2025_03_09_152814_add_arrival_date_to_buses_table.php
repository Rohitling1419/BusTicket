<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the newly created migration file
public function up()
{
    Schema::table('buses', function (Blueprint $table) {
        $table->date('arrival_date')->nullable(); // Make it nullable if you want
    });
}

public function down()
{
    Schema::table('buses', function (Blueprint $table) {
        $table->dropColumn('arrival_date');
    });
}

};
