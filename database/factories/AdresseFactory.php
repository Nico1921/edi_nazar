<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Adresse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Adresse>
 */
final class AdresseFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Adresse::class;

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
            'nom_contact' => fake()->word,
            'adresse1' => fake()->word,
            'adresse2' => fake()->word,
            'adresse3' => fake()->word,
            'code_postal' => fake()->word,
            'ville' => fake()->word,
            'pays' => fake()->word,
            'tel1' => fake()->word,
            'tel2' => fake()->word,
            'statut' => fake()->boolean,
        ];
    }
}
