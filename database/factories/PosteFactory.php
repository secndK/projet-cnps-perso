<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Poste;
use App\Models\TypePoste;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poste>
 */
class PosteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Poste::class;


    public function definition(): array
    {
        return [

            'num_serie_poste' => 'PDT-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),

            'num_inventaire_poste' =>  str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT) .'-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT) .'-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT) .'-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),

            'nom_poste' => $this->faker->randomElement(['DELL LATITUDE', 'MACBOOK AIR', 'HP PROBOOK', 'HP ELITE G6']) . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),

            'designation_poste' => 'N/A',

            'etat_poste' =>  'Bon',
            'statut_poste' =>  'disponible',

            'date_acq' => $this->faker->date('Y-m-d'),

            'type_poste_id' => TypePoste::factory(),

        ];
    }
}
