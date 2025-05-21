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
        Schema::create('action_historique_postes', function (Blueprint $table) {
            $table->id();
            $table->string('action_type'); // created, updated, deleted
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('poste_id')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_historiques_poste');
    }
};
