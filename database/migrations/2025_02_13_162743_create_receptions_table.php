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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string('reception_number');
            $table->string('payment_type');
            $table->date('reception_date');
            $table->date('realization_date');
            $table->date('experation_date');
            $table->double('total_HT');
            $table->double('total_TVA');
            $table->double('total_TTC');
            $table->double('TVA_rate');
            $table->foreignId('createdBy')->constrained('users')->onDelete('set null');
            $table->foreignId('updatedBy')->constrained('users')->onDelete('set null');
            $table->foreignId('supplier_id')->constrained()->onDelete('set null');
            $table->foreignId('entreprise_id')->constrained()->onDelete('set null');
            $table->foreignId('cash_register_id')->constrained()->onDelete('set null');
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receptions');
    }
};
