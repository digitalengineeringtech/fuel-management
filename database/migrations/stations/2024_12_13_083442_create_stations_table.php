<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('station_no', 20);
            $table->string('image');
            $table->string('phone_one', 20);
            $table->string('phone_two', 20);
            $table->string('address', 50);
            $table->dateTime('opening_date');
            $table->integer('subscribe_year');
            $table->datetime('expiry_date');
            $table->string('opening_hour');
            $table->string('closing_hour');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
