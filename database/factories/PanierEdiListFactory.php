<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PanierEdiList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PanierEdiList>
 */
final class PanierEdiListFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = PanierEdiList::class;

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
            'id_produit' => fake()->randomNumber(),
            'prix_ht_unitaire' => fake()->randomFloat(),
            'prix_taxe_unitaire' => fake()->randomFloat(),
            'prix_ttc_unitaire' => fake()->randomFloat(),
            'quantiter' => fake()->randomNumber(),
            'prix_ht_total' => fake()->randomFloat(),
            'prix_taxe_total' => fake()->randomFloat(),
            'prix_ttc_total' => fake()->randomFloat(),
            'id_client_edi' => fake()->randomNumber(),
        ];
    }
}
