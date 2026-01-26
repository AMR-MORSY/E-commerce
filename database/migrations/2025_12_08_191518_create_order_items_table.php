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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('product_color_id')->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_size_id')->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('color_name')->nullable();
            $table->string('size_name')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->decimal('final_price', 10, 2);
            $table->decimal('discount_amount', 10, 2);
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamps();

            $table->unique(['order_id','product_id','product_color_id','product_size_id'],'order_items_unique_combo');
            $table->unique(['order_id','product_id']);
            $table->unique(['order_id','product_id','product_color_id'],'order_items_unique_color');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
