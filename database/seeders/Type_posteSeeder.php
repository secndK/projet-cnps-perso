<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poste;
use App\Models\TypePoste;

class Type_posteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypePoste::factory()
        ->has(Poste::factory()->count(3))
        ->create();
    }
}
