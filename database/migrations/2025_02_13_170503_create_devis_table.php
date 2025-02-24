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
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('devis_number')->nullable();
            $table->string('title')->nullable();
            $table->text('subject')->nullable();
            $table->date('devis_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->decimal('total_HT')->nullable();
            $table->decimal('total_TVA')->nullable();
            $table->decimal('total_TTC')->nullable();
            $table->integer('TVA_rate')->nullable();
            $table->decimal('discount')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('entreprise_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
