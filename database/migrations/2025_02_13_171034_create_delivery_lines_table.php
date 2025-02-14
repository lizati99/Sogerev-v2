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
        Schema::create('delivery_lines', function (Blueprint $table) {
            $table->id();
            $table->double("unit_price");
            $table->integer("delivered_quantity");
            $table->double("total_price");
            $table->foreignId("delivery_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("product_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("stock_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_lines');
    }
};
