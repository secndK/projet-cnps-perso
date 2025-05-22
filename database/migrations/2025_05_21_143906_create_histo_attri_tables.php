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
        Schema::create('histo_attri_tables', function (Blueprint $table) {
            $table->id();
            $table->string('action_type');
            $table->foreignId('attribution_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // auteur
            $table->foreignId('agent_id')->constrained()->onDelete('cascade'); // bénéficiaire
            $table->json('postes')->nullable();
            $table->json('peripheriques')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histo_attri_tables');
    }
};
