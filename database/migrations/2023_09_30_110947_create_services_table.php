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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 2048)->required();
            $table->string('slug', 2500)->required();
            $table->float('price')->required();
            $table->string('youtube_video_id')->nullable();
            $table->text('description')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('is_bulk_order_allowed')->nullable();
            $table->string('order_type')->nullable();
            $table->string('service_type')->nullable();
            $table->string('is_submit_to_verified_allowed')->nullable();
            $table->string('is_cancelation_allowed')->nullable();
            $table->string('order_processing')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
