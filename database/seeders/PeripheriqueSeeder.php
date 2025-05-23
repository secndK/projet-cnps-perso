<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Peripherique;
use App\Models\TypePeripherique;

class PeripheriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typeripherique = TypePeripherique::factory()->create();
        Peripherique::factory()
            ->count(30)
            ->for($typeripherique)
            ->create();
    }
}
