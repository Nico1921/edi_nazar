<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommandeList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommandeList>
 */
final class CommandeListFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CommandeList::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_commande_list' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'date_saisie' => fake()->date(),
            'id_produit' => fake()->randomNumber(),
            'code_sku' => fake()->word,
            'gencode' => fake()->word,
            'prix_achat_ht' => fake()->randomFloat(),
            'prix_ht' => fake()->randomFloat(),
            'prix_total_ht' => fake()->randomFloat(),
            'prix_total_ttc' => fake()->randomFloat(),
            'taux_tva' => fake()->randomFloat(),
            'quantite' => fake()->randomNumber(),
            'remise' => fake()->randomFloat(),
            'prix_remise_ht' => fake()->randomFloat(),
            'total_tva' => fake()->randomFloat(),
            'note' => fake()->sentence,
            'id_facture' => fake()->randomNumber(),
            'id_transporteur' => fake()->randomNumber(),
            'num_colis' => fake()->word,
            'statut' => fake()->boolean,
            'drop_shipping' => fake()->boolean,
            'etat' => fake()->boolean,
            'date_livraison' => fake()->date(),
        ];
    }
}
