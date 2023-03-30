<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StatsProduit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\StatsProduit>
 */
final class StatsProduitFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = StatsProduit::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_stats_produit' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'id_produit' => fake()->randomNumber(),
            'qte_achetee' => fake()->randomNumber(),
            'qte_commande' => fake()->randomNumber(),
            'qte_arrivage' => fake()->randomNumber(),
            'stock_restant' => fake()->randomNumber(),
            'stock_option' => fake()->randomNumber(),
            'stock_bloque' => fake()->randomNumber(),
            'qte_destocke' => fake()->randomNumber(),
        ];
    }
}
