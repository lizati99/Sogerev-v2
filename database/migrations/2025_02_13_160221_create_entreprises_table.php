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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('RS');
            $table->text('description');
            $table->string('phone_number_1');
            $table->string('phone_number_2');
            $table->string('fix');
            $table->string('fax');
            $table->text('address');
            $table->string('city');
            $table->string('email')->nullable();
            $table->string('siteweb')->nullable();
            $table->string('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
