<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Panne>
 */
class PanneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'voie' => $this->faker->randomElement(['S1', 'S2', 'S3', 'E4', 'E5', 'E6']),
            'type' => $this->faker->randomElement(['LECTURE', 'PANNE_ELECTRICITE', 'BARRIERE', 'CLASSE']),
            'status' => $this->faker->randomElement(['En cours', 'Terminée', 'Annulée']),
            'comment' => $this->faker->sentence(), // Random comment
            'user_id' => User::factory(), // Randomly associate a user
        ];
    }
}
