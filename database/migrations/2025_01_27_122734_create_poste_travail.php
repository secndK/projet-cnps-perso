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
        Schema::disableForeignKeyConstraints();
        Schema::create('poste_travail', function (Blueprint $table) {
            $table->id();
            $table->string('num_serie_poste_travail')->unique();
            $table->string('num_inventaire_poste_travail');
            $table->string('nom_poste_travail');
            $table->string('designation_poste_travail')->nullable();
            $table->string('type_poste_travail');
            $table->string('etat_poste_travail');
            $table->dateTime('date_acq');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('poste_travail');


    }
};