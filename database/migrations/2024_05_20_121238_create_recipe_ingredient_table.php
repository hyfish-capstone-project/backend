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
        Schema::create('recipe_ingredient', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->references('id')->on('recipes')->onDelete('cascade')->constrained();
            $table->foreignId('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade')->constrained();
            $table->float('amount');
            $table->string('measurement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipe_ingridient');
    }
};
