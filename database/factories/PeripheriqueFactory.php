<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Peripherique;
use App\Models\TypePeripherique;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peripherique>
 */
class PeripheriqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Peripherique::class;

    public function definition(): array
    {
        return [
            'num_serie_peripherique' => 'PDT-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'num_inventaire_peripherique' =>  str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT) .'-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT) .'-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT) .'-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'nom_peripherique' => $this->faker->randomElement(['Souris Logitech', ' HP Clavier', 'HP Ecran', ' HP Imprimante', ' MTN BOX-WIFI']) . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'designation_peripherique' => 'N/A',
            'etat_peripherique' =>  'Bon',
            'statut_peripherique' =>  'disponible',
            'date_acq' => $this->faker->date('Y-m-d'),
            'type_peripherique_id' => TypePeripherique::factory(),
        ];
    }
}
