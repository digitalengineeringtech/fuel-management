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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id');
            $table->foreignId('dispenser_id');
            $table->foreignId('nozzle_id');
            $table->foreignId('fuel_type_id');
            $table->foreignId('payment_id')->nullable();
            $table->foreignId('discount_id')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('vehicle_type_id')->nullable();
            $table->string('tank_no');
            $table->string('voucher_no');
            $table->string('cashier_code');
            $table->string('car_no')->nullable();
            $table->string('device')->nullable(); // web, mobile, tablet
            $table->float('tank_balance')->default(0);
            $table->float('totalizer_liter')->default(0);
            $table->float('totalizer_amount')->default(0);
            $table->float('device_totalizer_liter')->default(0);
            $table->float('device_totalizer_amount')->default(0);
            $table->bigInteger('sale_price')->default(0);
            $table->bigInteger('sale_liter')->default(0);
            $table->bigInteger('total_price')->default(0);
            $table->dateTime('daily_report_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
