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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_amount', 10, 2); // e.g. 20 (for 20%) or 10000 (for Rp 10.000)
            $table->decimal('min_spend', 10, 2)->default(0);
            $table->decimal('max_discount', 10, 2)->nullable();
            $table->string('badge_tag')->default('FLASH SALE');
            $table->string('banner_gradient')->default('from-pink-500 to-orange-500');
            $table->dateTime('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
