<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Facture;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Facture>
 */
final class FactureFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Facture::class;

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
            'id_commande' => fake()->randomNumber(),
            'date_proforma' => fake()->date(),
            'num_proforma' => fake()->word,
            'date_facture' => fake()->date(),
            'num_facture' => fake()->word,
            'montant_ttc' => fake()->randomFloat(),
            'taux_tva' => fake()->randomFloat(),
            'montant_ht' => fake()->randomFloat(),
            'total_ht' => fake()->randomFloat(),
            'montant_tva' => fake()->randomFloat(),
            'montant_due_ttc' => fake()->randomFloat(),
            'montant_port_ht' => fake()->randomFloat(),
            'date_echeance' => fake()->date(),
            'gen_facture' => fake()->boolean,
            'observation' => fake()->text,
            'interne' => fake()->boolean,
            'exoneration' => fake()->word,
            'date_livraison' => fake()->date(),
            'reference' => fake()->word,
            'commission_ttc' => fake()->randomFloat(),
            'commission_ht' => fake()->randomFloat(),
            'commission_tva' => fake()->randomFloat(),
            'remboursement_ttc' => fake()->randomFloat(),
            'remboursement_ht' => fake()->randomFloat(),
            'remboursement_tva' => fake()->randomFloat(),
            'abonnement_ttc' => fake()->randomFloat(),
            'abonnement_ht' => fake()->randomFloat(),
            'abonnement_tva' => fake()->randomFloat(),
        ];
    }
}
