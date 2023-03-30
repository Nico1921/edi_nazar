<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Commande>
 */
final class CommandeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Commande::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'id_client' => fake()->randomNumber(),
            'date_commande' => fake()->date(),
            'num_commande' => fake()->word,
            'total_ttc' => fake()->randomFloat(),
            'taux_tva' => fake()->randomFloat(),
            'total_ht' => fake()->randomFloat(),
            'total_tva' => fake()->randomFloat(),
            'due_ttc' => fake()->randomFloat(),
            'commentaire' => fake()->text,
            'mois' => fake()->word,
            'mois2' => fake()->word,
            'num_commande_interne' => fake()->word,
        ];
    }
}
