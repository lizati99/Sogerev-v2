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
        Schema::create('order_drafts', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('title')->nullable();
            $table->text('subject')->nullable();
            $table->date('orderDraft_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->decimal('total_HT')->nullable();
            $table->decimal('total_TVA')->nullable();
            $table->decimal('total_TTC')->nullable();
            $table->integer('TVA_rate')->nullable();
            $table->decimal('discount')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->nullable();
            $table->boolean('isfinishing')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('devi_id')->constrained('devis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('entreprise_id')->nullable()->constrained('entreprises')->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('clients')->nullOnDelete();
            $table->foreignId('payment_type_id')->nullable()->constrained('payment_types')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_drafts');
    }
};
