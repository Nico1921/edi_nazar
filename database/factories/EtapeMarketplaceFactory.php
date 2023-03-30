<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\EtapeMarketplace;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\EtapeMarketplace>
 */
final class EtapeMarketplaceFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = EtapeMarketplace::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'date_ajout' => fake()->date(),
            'date_maj' => fake()->date(),
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'nom_etape' => fake()->word,
            'color_etape' => fake()->word,
            'url_etape' => fake()->word,
            'statut' => fake()->boolean,
            'sort_order' => fake()->boolean,
        ];
    }
}
