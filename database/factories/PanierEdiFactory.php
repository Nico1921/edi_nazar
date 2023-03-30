<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PanierEdi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PanierEdi>
 */
final class PanierEdiFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = PanierEdi::class;

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
            'num_commande' => fake()->word,
            'nb_client' => fake()->randomNumber(),
            'date_commande' => fake()->date(),
            'total_HT' => fake()->randomFloat(),
            'total_taxe' => fake()->randomFloat(),
            'total_ttc' => fake()->randomFloat(),
            'poids_total' => fake()->randomFloat(),
            'produits_total' => fake()->randomNumber(),
            'total_m2' => fake()->randomFloat(),
            'date_livraison' => fake()->date(),
            'total_payer' => fake()->randomFloat(),
            'payment_type' => fake()->boolean,
            'is_validate' => fake()->boolean,
            'is_marketplace' => fake()->boolean,
            'id_etape' => fake()->randomNumber(),
            'id_users' => fake()->randomNumber(),
        ];
    }
}
