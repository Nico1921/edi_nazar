<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AdresseMarketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AdresseMarketplace>
 */
final class AdresseMarketplaceFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = AdresseMarketplace::class;

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
            'adresse1' => fake()->word,
            'adresse2' => fake()->word,
            'adresse3' => fake()->word,
            'code_postal' => fake()->word,
            'ville' => fake()->word,
            'pays' => fake()->word,
            'nom_contact' => fake()->word,
            'tel1' => fake()->word,
            'email' => fake()->safeEmail,
            'code1' => fake()->word,
            'code2' => fake()->word,
            'delai' => fake()->word,
            'note' => fake()->sentence,
            'pr_nom' => fake()->word,
            'pr_id' => fake()->word,
            'is_pr' => fake()->boolean,
            'id_commande' => fake()->randomNumber(),
            'tel2' => fake()->word,
            'is_relai' => fake()->boolean,
        ];
    }
}
