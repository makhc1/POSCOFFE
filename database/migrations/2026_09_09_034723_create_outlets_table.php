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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('operating_hours')->default('08:00 - 24:00');
            $table->text('google_maps_url')->nullable();
            $table->boolean('is_24_hours')->default(false);
            $table->boolean('has_wifi')->default(true);
            $table->boolean('has_drive_thru')->default(false);
            $table->boolean('has_outdoor')->default(true);
            $table->boolean('has_musholla')->default(true);
            $table->boolean('has_colokan')->default(true);
            $table->string('status')->default('Buka'); // Buka, Ramai, Tutup
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
