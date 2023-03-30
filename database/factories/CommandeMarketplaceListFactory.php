<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommandeMarketplaceList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommandeMarketplaceList>
 */
final class CommandeMarketplaceListFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CommandeMarketplaceList::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_commande' => fake()->randomNumber(),
            'id_produit' => fake()->randomNumber(),
            'ref_produit' => fake()->word,
            'nom_produit' => fake()->word,
            'quantite' => fake()->randomNumber(),
            'taux_tva' => fake()->randomFloat(),
            'prix_ht' => fake()->randomFloat(),
            'prix_ttc' => fake()->randomFloat(),
            'eco_ttc' => fake()->randomFloat(),
            'remise' => fake()->randomFloat(),
            'commission_p' => fake()->randomFloat(),
            'commission_ttc' => fake()->randomFloat(),
            'frais_port_ttc' => fake()->randomFloat(),
            'total_tva' => fake()->randomFloat(),
            'total_ht' => fake()->randomFloat(),
            'total_ttc' => fake()->randomFloat(),
            'frais_port_ht' => fake()->randomFloat(),
            'total_port_ttc' => fake()->randomFloat(),
            'total_port_ht' => fake()->randomFloat(),
            'total_eco_ht' => fake()->randomFloat(),
            'total_eco_ttc' => fake()->randomFloat(),
            'ref_couleur' => fake()->word,
            'nom_couleur' => fake()->word,
            'barcode' => fake()->word,
            'id_categorie' => fake()->randomNumber(),
            'code_EAN' => fake()->word,
            'remise_sup_ttc' => fake()->randomFloat(),
            'prix_achat_ht' => fake()->randomFloat(),
            'pourcentage_produit' => fake()->randomFloat(),
            'delai' => fake()->text,
            'note' => fake()->sentence,
            'qte_preparee' => fake()->randomNumber(),
            'date_preparee' => fake()->dateTime(),
            'rupture' => fake()->randomNumber(),
            'manuel' => fake()->boolean,
            'order_item_id' => fake()->word,
        ];
    }
}
