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
            $table->string('numero');
            $table->string('title');
            $table->text('sujet');
            $table->double('total_HT');
            $table->double('total_TVA');
            $table->double('total_TTC');
            $table->double('TVA_rate');
            $table->date('orderDraft_date');
            $table->string('status');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('updated_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('devi_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

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
