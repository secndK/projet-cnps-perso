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
        Schema::create('attribution_poste', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribution_id')->constrained('attributions')->onDelete('cascade');
            $table->foreignId('poste_id')->constrained('postes')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribution_poste');
    }
};
