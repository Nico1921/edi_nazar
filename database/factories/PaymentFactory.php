<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Payment>
 */
final class PaymentFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Payment::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_commande' => fake()->randomNumber(),
            'id_facture' => fake()->randomNumber(),
            'date_ajout' => fake()->dateTime(),
            'date_maj' => fake()->dateTime(),
            'payment_type' => fake()->boolean,
            'nature' => fake()->word,
            'transaction' => fake()->word,
            'date_payment' => fake()->date(),
            'amount_ttc' => fake()->randomFloat(),
            'bank_charges' => fake()->randomFloat(),
            'comments' => fake()->word,
            'id_avoir' => fake()->randomNumber(),
        ];
    }
}
