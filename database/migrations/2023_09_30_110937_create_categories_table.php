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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('name')->required();
            $table->string('slug')->required();
            $table->integer('sort_order')->nullable();
            $table->text('description')->nullable();
            $table->string('icon_path', 2048)->nullable();
            $table->string('cover_path', 2048)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->string('cache_key')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
