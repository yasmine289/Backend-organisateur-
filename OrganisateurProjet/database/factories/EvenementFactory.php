<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Emplacement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evenement>
 */
class EvenementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = now()->addDays(rand(1, 365));
        return [
            'titre' => $this->faker->sentence(4),
            'description' => $this->faker->paragraphs(3, true),
            'date_evenement' => $startDate,
            'date_fin' => $startDate->addHours(rand(2, 8)),
            'user_id' => User::factory(),
            'categorie_id' => Categorie::factory(),
            'emplacement_id' => Emplacement::factory(),
            'prix' => $this->faker->randomElement([0, 10, 20, 50, 100]),
            'nombre_places' => $this->faker->numberBetween(10, 500),
            'image_url' => $this->faker->imageUrl(800, 600, 'events'),
            'statut' => $this->faker->randomElement(['actif', 'annulé', 'complet']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
