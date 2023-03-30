<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Couleur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Couleur>
 */
final class CouleurFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Couleur::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_couleur' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'nom_couleur' => fake()->word,
            'url_couleur' => fake()->word,
            'statut' => fake()->randomNumber(),
            'sort_order' => fake()->randomNumber(),
        ];
    }
}
