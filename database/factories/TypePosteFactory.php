<?php

namespace Database\Factories;
use App\Models\TypePoste;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypePoste>
 */
class TypePosteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TypePoste::class;


    public function definition(): array
    {
        return [
            'libelle_type' => $this->faker->randomElement(['PC Bureau', 'PC portable', 'Téléphone IP']),
        ];
    }
}
