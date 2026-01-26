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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->index()->constrained()->onDelete('cascade');
            $table->foreignId('product_color_id')->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_size_id')->index()->nullable()->constrained()->onDelete('cascade');   
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unique(['cart_id','product_id','product_color_id','product_size_id'], 'cart_items_unique_combo');
            $table->unique(['cart_id','product_id','product_color_id'], 'cart_items_unique_color');

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
