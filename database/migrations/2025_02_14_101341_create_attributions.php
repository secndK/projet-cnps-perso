<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up(): void
    {
        Schema::create('attributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('poste_id')->constrained('postes')->onDelete('cascade');
            // $table->foreignId('peripherique_id')->constrained()->onDelete('cascade');
            $table->date('date_attribution');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributions');
        Schema::dropIfExists('peripherique_attribution');
        Schema::dropIfExists('poste_attribution');
        Schema::dropIfExists('attributions');
    }
};
