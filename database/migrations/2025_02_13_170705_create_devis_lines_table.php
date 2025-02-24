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
        Schema::create('devis_lines', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->string('unitMeasure')->nullable();
            $table->decimal('unitprice_HT')->nullable();
            $table->integer('TVA_rate')->nullable();
            $table->decimal('total_TVA')->nullable();
            $table->decimal('total_HT')->nullable();
            $table->decimal('total_TTC')->nullable();
            $table->foreignId('devi_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis_lines');
    }
};
