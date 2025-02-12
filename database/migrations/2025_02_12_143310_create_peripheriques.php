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
        Schema::create('peripheriques', function (Blueprint $table) {
            $table->id();
            $table->string('num_serie_peripherique')->unique();
            $table->string('num_inventaire_peripherique');
            $table->string('nom_peripherique');
            $table->string('designation_peripherique')->nullable();
            $table->string('etat_peripherique')->nullable();
            $table->dateTime('date_acq');
            //les clés étrangères
            $table->foreignId('agent_id')->nullable() //clé agents
                ->constrained('agents')
                ->onDelete('cascade');
            $table->foreignId('poste_id')->nullable() //clé type postes
                ->constrained('postes')
                ->onDelete('cascade');
                $table->foreignId('type_peripherique_id')->nullable()  //clé type peripheriques
                ->constrained('types_peripheriques')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peripheriques');
    }
};
