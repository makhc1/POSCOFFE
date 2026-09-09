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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('image_url')->nullable();
            $table->boolean('is_best_seller')->default(false);
            $table->boolean('is_spicy_or_bold')->default(false);
            $table->integer('caffeine_level')->default(1); // 0 (Decaf/Non-Coffee) - 10 (Setan Roast)
            $table->integer('spicy_level')->default(0); // 0 - 8 (Level Hompimpa - Setan)
            $table->string('badge')->nullable(); // e.g. "HOT PROMO", "BEST SELLER", "VIRAL"
            $table->boolean('is_available')->default(true);
            $table->decimal('rating', 3, 1)->default(4.9);
            $table->integer('review_count')->default(120);
            $table->string('serving_type')->default('iced'); // iced, hot, both, food
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
