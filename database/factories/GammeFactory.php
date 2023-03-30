<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Gamme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Gamme>
 */
final class GammeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Gamme::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_gamme' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'nom_gamme' => fake()->word,
            'composition' => fake()->text,
            'id_special' => fake()->randomNumber(),
            'id_fabrication' => fake()->randomNumber(),
            'poids_m2_KG' => fake()->randomFloat(),
            'hauteur_mm' => fake()->randomFloat(),
            'url_gamme' => fake()->word,
            'sort_order' => fake()->randomNumber(),
            'prix_achat_ht_m2' => fake()->randomFloat(),
            'prix_vente_ht_m2' => fake()->randomFloat(),
            'img_gamme' => fake()->word,
            'type_poils' => fake()->boolean,
            'uv_proof' => fake()->boolean,
            'type_tapis' => fake()->boolean,
            'in_edi' => fake()->boolean,
            'statut' => fake()->boolean,
            'id_design' => \App\Models\Design::factory(),
        ];
    }
}
