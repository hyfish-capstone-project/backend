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
        Schema::create('captures', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('image_url');
            $table->string('freshness')->nullable();
            $table->float('score');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->constrained();
            $table->unsignedBigInteger('fish_id')->nullable();
            $table->foreign('fish_id')->references('id')->on('fishes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captures');
    }
};
