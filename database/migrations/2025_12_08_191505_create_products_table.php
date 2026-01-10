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
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->string('sku')->unique()->nullable();     
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('has_discount')->default(false);
            $table->enum('discount_type', ['percentage', 'fixed'])->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->timestamp('discount_starts_at')->nullable();
            $table->timestamp('discount_ends_at')->nullable();
            $table->boolean('free_shipping')->default(false);
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
