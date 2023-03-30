<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ClientEDI;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClientEDI>
 */
final class ClientEDIFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ClientEDI::class;

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
            'nom' => fake()->word,
            'prenom' => fake()->word,
            'email' => fake()->safeEmail,
            'tel' => fake()->word,
            'date_commande' => fake()->date(),
            'ref_externe' => fake()->word,
            'nom_adresse' => fake()->word,
            'adresse1' => fake()->word,
            'adresse2' => fake()->word,
            'adresse3' => fake()->word,
            'pays' => fake()->word,
            'code_postal' => fake()->word,
            'ville' => fake()->word,
            'nom_adresse_facturation' => fake()->word,
            'adresse1_facturation' => fake()->word,
            'adresse2_facturation' => fake()->word,
            'adresse3_facturation' => fake()->word,
            'pays_facturation' => fake()->word,
            'code_postal_facturation' => fake()->word,
            'ville_facturation' => fake()->word,
            'num_commande' => fake()->word,
            'quantiter' => fake()->randomNumber(),
            'poids' => fake()->randomFloat(),
            'total_ht' => fake()->randomFloat(),
            'total_taxe' => fake()->randomFloat(),
            'total_ttc' => fake()->randomFloat(),
            'total_m2' => fake()->randomFloat(),
            'id_panier_edi' => \App\Models\PanierEdi::factory(),
            'id_client_edi' => \App\Models\PanierEdiList::factory(),
        ];
    }
}
