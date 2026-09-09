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
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->string('order_type')->default('dine_in'); // dine_in, takeaway, delivery
            $table->string('table_number')->nullable();
            $table->text('delivery_address')->nullable();
            $table->foreignId('outlet_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->string('voucher_code')->nullable();
            $table->string('status')->default('brewing'); // pending, brewing, ready, completed, cancelled
            $table->string('payment_method')->default('qris'); // qris, gopay, bca, cash
            $table->string('payment_status')->default('paid'); // paid, unpaid
            $table->text('notes')->nullable();
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
