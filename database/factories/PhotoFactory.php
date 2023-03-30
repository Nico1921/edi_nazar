<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Photo>
 */
final class PhotoFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Photo::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_photo' => fake()->randomNumber(),
            'id_produit' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'img_produit' => fake()->word,
            'principale' => fake()->boolean,
            'statut' => fake()->boolean,
            'sort_order' => fake()->randomNumber(),
        ];
    }
}
