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
        Schema::create('poste_peripherique', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postetra_id');
            $table->unsignedBigInteger('peripherique_id');

            $table->foreign('postetra_id')
                  ->references('id')
                  ->on('postetra')
                  ->onDelete('cascade');

            $table->foreign('peripherique_id')
                  ->references('id')
                  ->on('peripherique')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poste_peripherique');
    }
};