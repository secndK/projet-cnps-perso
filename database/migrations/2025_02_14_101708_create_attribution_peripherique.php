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
        Schema::create('attribution_peripherique', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribution_id')->constrained('attributions')->onDelete('cascade');
            $table->foreignId('peripherique_id')->constrained('peripheriques')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribution_peripherique');
    }
};

