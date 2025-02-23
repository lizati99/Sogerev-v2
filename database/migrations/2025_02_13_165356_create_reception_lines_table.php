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
        Schema::create('reception_lines', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->string('unitMeasure')->nullable();
            $table->string('productStatus')->nullable();
            $table->double('unitPriceHT')->nullable();
            $table->double('TVA_rate')->nullable();
            $table->double('totalTVA')->nullable();
            $table->double('totalHT')->nullable();
            $table->double('totalTTC')->nullable();
            $table->foreignId('reception_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('stock_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reception_lines');
    }
};
