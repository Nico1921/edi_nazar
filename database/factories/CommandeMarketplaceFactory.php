<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommandeMarketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommandeMarketplace>
 */
final class CommandeMarketplaceFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = CommandeMarketplace::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'id_livraison' => fake()->randomNumber(),
            'id_etape' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_client' => fake()->randomNumber(),
            'date_commande' => fake()->dateTime(),
            'num_commande' => fake()->word,
            'quantite' => fake()->randomNumber(),
            'taux_tva' => fake()->randomFloat(),
            'montant_ht' => fake()->randomFloat(),
            'montant_tva' => fake()->randomFloat(),
            'montant_ttc' => fake()->randomFloat(),
            'remise_ttc' => fake()->randomFloat(),
            'frais_port_ht' => fake()->randomFloat(),
            'frais_port_tva' => fake()->randomFloat(),
            'frais_port_ttc' => fake()->randomFloat(),
            'due_ttc' => fake()->randomFloat(),
            'total_tva' => fake()->randomFloat(),
            'total_ht' => fake()->randomFloat(),
            'total_ttc' => fake()->randomFloat(),
            'date_facture' => fake()->date(),
            'num_facture' => fake()->word,
            'date_env_order' => fake()->dateTime(),
            'send_order' => fake()->boolean,
            'date_env_invoice' => fake()->dateTime(),
            'send_invoice' => fake()->boolean,
            'commentaire' => fake()->text,
            'gen_facture' => fake()->boolean,
            'date_echeance' => fake()->date(),
            'statut' => fake()->boolean,
            'nom_etape' => fake()->word,
            'mode_reglement' => fake()->boolean,
            'date_envoie' => fake()->dateTime(),
            'env_order' => fake()->randomNumber(),
            'CGV' => fake()->boolean,
            'id_distributeur' => fake()->randomNumber(),
            'md5_commande' => fake()->word,
            'ref_externe' => fake()->word,
            'commission_p' => fake()->randomFloat(),
            'commission_ht' => fake()->randomFloat(),
            'commission_ttc' => fake()->randomFloat(),
            'import' => fake()->boolean,
            'total_eco_ht' => fake()->randomFloat(),
            'total_eco_ttc' => fake()->randomFloat(),
            'id_societe' => fake()->randomNumber(),
            'frais_supp_ht' => fake()->randomFloat(),
            'frais_supp_tva' => fake()->randomFloat(),
            'frais_supp_ttc' => fake()->randomFloat(),
            'infos' => fake()->text,
            'frais_port_reel_ttc' => fake()->randomFloat(),
            'id_reduction' => fake()->randomNumber(),
            'provenance' => fake()->boolean,
            'mode_livraison' => fake()->word,
            'is_market' => fake()->boolean,
            'date_expedition' => fake()->date(),
            'date_livraison' => fake()->date(),
            'date_delivery' => fake()->date(),
            'marge_ht' => fake()->randomFloat(),
            'is_ws' => fake()->boolean,
            'id_transport' => fake()->randomNumber(),
            'poids' => fake()->randomFloat(),
            'order_id' => fake()->randomNumber(),
            'filled' => fake()->boolean,
            'return_id' => fake()->randomNumber(),
            'total_refund' => fake()->randomFloat(),
            'tracking_sm' => fake()->boolean,
        ];
    }
}
