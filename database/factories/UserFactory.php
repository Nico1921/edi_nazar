<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'img_profil' => fake()->text,
            'email' => fake()->safeEmail,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'id_client' => fake()->randomNumber(),
            'statut' => 1,
        ];
    }
}
