<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommandeStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommandeStock>
 */
final class CommandeStockFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CommandeStock::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_commande' => fake()->randomNumber(),
            'id_commande_list' => fake()->randomNumber(),
            'id_produit' => fake()->randomNumber(),
            'id_stock' => fake()->randomNumber(),
            'quantite' => fake()->randomNumber(),
            'etape' => fake()->boolean,
            'id_preparation' => fake()->randomNumber(),
            'id_livraison' => fake()->randomNumber(),
            'id_facture' => fake()->randomNumber(),
            'id_commande_mkp' => fake()->randomNumber(),
            'id_commande_mkp_list' => fake()->randomNumber(),
            'date_expedition' => fake()->date(),
            'tracking' => fake()->word,
            'qte_preparee' => fake()->randomNumber(),
        ];
    }
}
