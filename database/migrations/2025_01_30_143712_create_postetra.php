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

        Schema::create('postetra', function (Blueprint $table) {
            $table->id();
            $table->string('num_serie_postetra')->unique();
            $table->string('num_inventaire_postetra');
            $table->string('nom_postetra');
            $table->string('designation_postetra')->nullable();
            $table->string('type_postetra');
            $table->string('etat_postetra');
            $table->dateTime('date_acq');
            $table->foreignId('agent_id')
            ->constrained('agents')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */


    public function down(): void
    {
        Schema::dropIfExists('postetra');
    }
};