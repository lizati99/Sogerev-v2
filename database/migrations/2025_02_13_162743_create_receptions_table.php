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
            $table->foreignId('createdBy')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updatedBy')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('entreprise_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('cash_register_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('purchase_order_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
