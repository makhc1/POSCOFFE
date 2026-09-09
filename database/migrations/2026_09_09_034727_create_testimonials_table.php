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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_handle')->nullable();
            $table->string('avatar_url')->nullable();
            $table->integer('rating')->default(5);
            $table->text('comment');
            $table->string('favorite_menu')->nullable();
            $table->string('outlet_name')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
