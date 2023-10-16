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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['collection', 'item'])->default('item');
            $table->string('name')->required();
            $table->string('link', 2048)->nullable();
            $table->boolean('is_published')->nullable()->default(true);;
            $table->string('cache_key')->nullable();
            $table->integer('sort_order')->nullable();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('parent_id')->nullable()->constrained('menus');
            $table->foreignId('collection_id')->nullable()->constrained('menus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
