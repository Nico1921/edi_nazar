<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Produit>
 */
final class ProduitFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Produit::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_produit' => \App\Models\PanierEdiList::factory(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'id_design' => fake()->randomNumber(),
            'id_couleur' => fake()->randomNumber(),
            'id_dimension' => fake()->randomNumber(),
            'code_sku' => fake()->word,
            'gencode' => fake()->word,
            'prix_achat_ht' => fake()->randomFloat(),
            'prix_vente_ht' => fake()->randomFloat(),
            'prix_achat_ht_DS' => fake()->randomFloat(),
            'prix_vente_ht_DS' => fake()->randomFloat(),
            'prix_conseille_ttc' => fake()->randomFloat(),
            'prix_public_ttc' => fake()->randomFloat(),
            'statut' => fake()->randomNumber(),
            'drop_shipping' => fake()->randomNumber(),
            'stock' => fake()->randomNumber(),
            'nom_list' => fake()->word,
            'gencode2' => fake()->word,
            'reappro' => fake()->randomNumber(),
            'stock_mini' => fake()->randomNumber(),
            'stock_maxi' => fake()->randomNumber(),
            'is_ok' => fake()->randomNumber(),
            'id_produit_ref' => fake()->randomNumber(),
            'gamme_id' => fake()->randomNumber(),
        ];
    }
}
