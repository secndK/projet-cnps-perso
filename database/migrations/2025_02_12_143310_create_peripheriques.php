<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

            // Corrected foreign key declarations
            $table->foreignId('user_id')->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('poste_id')->nullable()
                  ->constrained('postes')
                  ->onDelete('cascade');

            $table->foreignId('type_peripherique_id')->nullable()
                  ->constrained('types_peripheriques')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peripheriques');
        Schema::dropIfExists('postes');
    }
};
