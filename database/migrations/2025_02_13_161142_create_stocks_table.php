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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('current_stock')->nullable();
            $table->integer('stock_min')->nullable();
            $table->integer('stock_in')->nullable();
            $table->integer('stock_out')->nullable();
            $table->integer('stock_stolen')->nullable();
            $table->integer('stock_damaged')->nullable();
            $table->integer('stock_returned')->nullable();

            // Relationship with products
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
