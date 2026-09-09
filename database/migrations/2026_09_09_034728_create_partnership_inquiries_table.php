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
        Schema::create('partnership_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('franchise'); // franchise, career
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('location_plan_or_position')->nullable();
            $table->string('budget_or_experience')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('baru'); // baru, diproses, selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership_inquiries');
    }
};
