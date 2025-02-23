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
        Schema::create('order_draft_lines', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->integer('unit_price');
            $table->double('quantity');
            $table->integer('TVA_rate');
            $table->double('price_HT');
            $table->foreignId('order_draft_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_draft_lines');
    }
};
