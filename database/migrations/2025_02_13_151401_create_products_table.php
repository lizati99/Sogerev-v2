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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('ref')->nullable();
            $table->text('description')->nullable();
            $table->double('pricePurchase')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('unit_price_min')->nullable();
            $table->double('unit_price_max')->nullable();
            // $table->integer('quantity')->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('createdBy')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('updatedBy')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('subCategory_id')->constrained('sub_categories')->onDelete('cascade');
            // $table->foreignId('stock_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
