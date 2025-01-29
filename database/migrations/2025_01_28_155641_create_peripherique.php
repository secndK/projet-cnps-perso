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
        Schema::create('peripherique', function (Blueprint $table) {
            $table->id();
            $table->string('num_serie_peripherique')->unique();
            $table->string('num_inventaire_peripherique');
            $table->string('nom_peripherique');
            $table->string('designation_peripherique')->nullable();
            $table->string('type_peripherique')->nullable();
            $table->string('etat_peripherique')->nullable();
            $table->dateTime('date_acq');
            $table->unsignedBigInteger('poste_travail_id')->nullable();
            $table->foreign('poste_travail_id')->references('id')->on('poste_travail')->onDelete('set null');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down()
    {
        Schema::table('peripherique', function (Blueprint $table) {
            $table->dropForeign(['poste_travail_id']);
            $table->dropColumn('poste_travail_id');
        });

        Schema::dropIfExists('peripherique');
    }
};