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
            $table->foreignId('user_id')->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->string('status')->default('pending'); // pending, processing, shipped, delivered, cancelled
            $table->string('payment_method')->default('COD');//COD,Credit card,instapay
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->timestamp('paid_at')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('shipping_address');
            $table->text('billing_address')->nullable();
            $table->string('shipping_city');
            $table->string('shipping_state')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->string('shipping_country')->default('Egypt');
            $table->string('transaction_id')->nullable();
            $table->decimal('discount_amount',10,2)->default(0);
            $table->foreignId('shipping_rule_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('coupon_code')->nullable();
            $table->boolean('has_free_shipping_product')->default(0);
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
