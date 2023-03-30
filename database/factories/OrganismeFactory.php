<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Organisme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Organisme>
 */
final class OrganismeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Organisme::class;

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
            'id_user' => fake()->randomNumber(),
            'id_user_maj' => fake()->randomNumber(),
            'name_organisme' => fake()->word,
            'email' => fake()->safeEmail,
            'address1' => fake()->streetAddress,
            'address2' => fake()->secondaryAddress,
            'address3' => fake()->word,
            'zipcode' => fake()->word,
            'city' => fake()->city,
            'country' => fake()->country,
            'tel' => fake()->word,
            'fax' => fake()->word,
            'website' => fake()->word,
            'capital' => fake()->word,
            'RCI' => fake()->word,
            'SIRET' => fake()->word,
            'APE' => fake()->word,
            'formation' => fake()->word,
            'VAT' => fake()->word,
            'owner_bank' => fake()->word,
            'domiciliation_bank' => fake()->word,
            'name_bank' => fake()->word,
            'address_bank' => fake()->word,
            'cp_bank' => fake()->word,
            'city_bank' => fake()->word,
            'country_bank' => fake()->word,
            'bank_code' => fake()->word,
            'branch_code' => fake()->word,
            'account_bank' => fake()->word,
            'key_digits' => fake()->word,
            'swift_bic' => fake()->word,
            'iban' => fake()->iban(),
            'statut' => fake()->boolean,
        ];
    }
}
