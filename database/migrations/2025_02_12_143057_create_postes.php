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
        Schema::create('postes', function (Blueprint $table) {
            $table->id();
            $table->string('num_serie_poste')->unique();
            $table->string('num_inventaire_poste');
            $table->string('nom_poste');
            $table->string('designation_poste')->nullable();
            $table->string('etat_poste')->nullable();
            $table->string('statut_poste')->nullable();
            $table->dateTime('date_acq');
            $table->foreignId('agent_id')->nullable()
            ->constrained('agents')
            ->onDelete('cascade');
            $table->foreignId('type_poste_id')->constrained('types_postes')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribution_poste');
        Schema::dropIfExists('postes');
    }
};
