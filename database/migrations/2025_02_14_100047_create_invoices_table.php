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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('invoice_date');
            $table->date('expiry_date');
            $table->double('total_HT');
            $table->double('total_TVA');
            $table->double('total_TTC');
            $table->double('tva_rate');
            $table->string('payment_status');
            $table->foreignId('from_id')->constrained("entreprises")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('to_id')->constrained("clients")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('delivery_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('counter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
