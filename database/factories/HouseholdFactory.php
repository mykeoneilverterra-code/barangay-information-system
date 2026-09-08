<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseholdFactory extends Factory
{
    public function definition(): array
    {
        return [
            'household_number' => fake()->unique()->numerify('HH-#####'),
            'household_head' => fake()->name(),
            'address' => fake()->streetAddress(),
            'purok' => fake()->randomElement([
                'Purok 1',
                'Purok 2',
                'Purok 3',
                'Purok 4',
                'Purok 5',
            ]),
            'contact_number' => fake()->numerify('09#########'),
        ];
    }
}