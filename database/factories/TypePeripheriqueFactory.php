<?php
namespace Database\Factories;
use App\Models\TypePeripherique;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypePeripherique>
 */
class TypePeripheriqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TypePeripherique::class;

    public function definition(): array
    {
        return [
            'libelle_type' => $this->faker->randomElement(['Souris', 'Écran', 'Clavier', 'Box wi-fi', 'Imprimante', 'Pocket wi-fi (dominos)']),
        ];
    }
}
