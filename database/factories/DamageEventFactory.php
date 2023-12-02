<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DamageEvent>
 */
class DamageEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location' => fake("hu_HU") -> smallerCity(),
            'date' => fake() -> dateTime(),
            'description' => fake() -> text()
        ];
    }
}
