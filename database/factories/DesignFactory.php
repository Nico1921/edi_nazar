<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Design;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Design>
 */
final class DesignFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Design::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_design' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'nom_design' => fake()->word,
            'id_gamme' => fake()->randomNumber(),
            'url_design' => fake()->word,
            'statut' => fake()->randomNumber(),
            'sort_order' => fake()->randomNumber(),
        ];
    }
}
