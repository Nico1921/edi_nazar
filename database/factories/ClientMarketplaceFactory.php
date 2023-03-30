<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClientMarketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClientMarketplace>
 */
final class ClientMarketplaceFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ClientMarketplace::class;

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
            'email' => fake()->safeEmail,
            'num_client' => fake()->word,
            'is_societe' => fake()->boolean,
            'civilite' => fake()->word,
            'societe' => fake()->word,
            'nom' => fake()->word,
            'prenom' => fake()->word,
            'tva_intra' => fake()->word,
            'siret' => fake()->word,
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
            'commentaire' => fake()->text,
            'newsletter' => fake()->boolean,
            'id_type_client' => fake()->randomNumber(),
            'commission' => fake()->randomFloat(),
            'code_compta' => fake()->word,
        ];
    }
}
