<?php

namespace Database\Seeders;

use App\Models\Poste;
use App\Models\TypePoste;
use Database\Factories\PosteFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class PosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $model = Poste::class;


    public function run(): void
    {
        $typeposte = TypePoste::factory()->create();

        Poste::factory()
            ->count(30)
            ->for($typeposte)
            ->create();
    }
}
