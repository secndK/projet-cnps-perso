<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
    */

    protected static $counter = 1; // compteur initial
    protected $model = Agent::class;

    /*
     * @return array<string, mixed>
     */
    public function definition(): array
    {

         $matricule = 'M-' . str_pad((string) static::$counter, 5, '0', STR_PAD_LEFT);
        static::$counter++; // incrémente le compteur à chaque utilisateur


        return [

             'matricule_agent' => $matricule,
             'nom_agent' => $this->faker->lastName(),
             'prenom_agent' => $this->faker->firstName(),
             'direction_agent' => $this->faker->randomElement(['DSI', 'RH', 'DPRESS', 'COMPTABILITÉ', 'AUDIT',]),
             'localisation_agent' => $this->faker->randomElement(['1ER ETAGE', '2E ETAGES', '3E ETAGES', '4E ETAGES']),

        ];
    }
}
