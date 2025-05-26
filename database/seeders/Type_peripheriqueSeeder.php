<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peripherique;
use App\Models\TypePeripherique;

class Type_peripheriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TypePeripherique::factory()
        ->has(Peripherique::factory()->count(30))
        ->create();

    }
}