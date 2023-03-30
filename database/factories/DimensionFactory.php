<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Dimension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Dimension>
 */
final class DimensionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Dimension::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_dimension' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'largeur' => fake()->randomNumber(),
            'longueur' => fake()->randomNumber(),
            'url_dimension' => fake()->word,
            'statut' => fake()->boolean,
            'sort_order' => fake()->randomNumber(),
        ];
    }
}
