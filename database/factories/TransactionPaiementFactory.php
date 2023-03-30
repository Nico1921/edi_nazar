<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TransactionPaiement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TransactionPaiement>
 */
final class TransactionPaiementFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = TransactionPaiement::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'id_transaction_paiement' => fake()->randomNumber(),
            'transaction_id' => fake()->word,
            'date_transaction' => fake()->dateTime(),
        ];
    }
}
