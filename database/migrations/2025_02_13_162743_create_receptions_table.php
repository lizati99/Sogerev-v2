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
            $table->string('reception_number')->nullable();
            $table->text('sujet')->nullable();
            $table->date('reception_date')->nullable();
            $table->date('realization_date')->nullable();
            $table->date('experation_date')->nullable();
            $table->double('total_HT')->nullable();
            $table->double('total_TVA')->nullable();
            $table->double('total_TTC')->nullable();
            $table->double('TVA_rate')->nullable();
            $table->double('discount')->nullable();
            $table->string('status')->nullable();
            $table->text('remarque')->nullable();
            $table->foreignId('createdBy')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updatedBy')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('payment_type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('entreprise_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('cash_register_id')->nullable()->constrained()->nullOnDelete();
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
