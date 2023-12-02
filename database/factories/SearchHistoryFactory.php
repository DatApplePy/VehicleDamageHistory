<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchHistory>
 */
class SearchHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = fake();
        $faker -> addProvider(new Fakecar($faker));

        return [
            'license_plate' => $faker -> vehicleRegistration(),
            'date' => now(),
            'user_id' => fake() -> randomDigit()
        ];
    }
}
