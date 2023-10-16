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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->float('qty')->nullable();
            $table->string('order_type')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('device')->nullable();
            $table->string('order_note', 2048)->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->enum('order_status', ['pending', 'complate', 'cancel'])->default('pending');
            $table->enum('payment_status', ['pending', 'complate', 'cancel'])->default('pending');
            $table->foreignId('service_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
