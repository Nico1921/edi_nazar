<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Client>
 */
final class ClientFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Client::class;

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
            'num_client' => fake()->word,
            'nom_societe' => fake()->word,
            'tva_intra' => fake()->word,
            'contact' => fake()->word,
            'email' => fake()->safeEmail,
            'adresse1' => fake()->word,
            'adresse2' => fake()->word,
            'adresse3' => fake()->word,
            'code_postal' => fake()->word,
            'ville' => fake()->word,
            'pays' => fake()->word,
            'tel1' => fake()->word,
            'tel2' => fake()->word,
            'fax' => fake()->word,
            'url_client' => fake()->word,
            'is_client' => fake()->boolean,
            'is_fournisseur' => fake()->boolean,
            'has_distributeur' => fake()->boolean,
            'is_validate' => fake()->boolean,
            'is_edi' => fake()->boolean,
            'taux_remise' => fake()->randomNumber(),
            'social_twitter' => fake()->word,
            'social_insta' => fake()->word,
            'social_facebook' => fake()->word,
            'social_linkedin' => fake()->word,
            'social_website' => fake()->word,
            'path_kbis' => fake()->word,
            'path_identiter' => fake()->word,
            'id_client' => \App\Models\User::factory(),
        ];
    }
}
