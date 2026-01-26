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
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->index()->constrained()->cascadeOnDelete();
            $table->string('name'); // e.g., "Red", "Blue"
            $table->string('hex_code')->nullable(); // e.g., "#FF0000"
            $table->integer('quantity')->nullable();
              // For bags (variable_color), quantity stored on color level
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
