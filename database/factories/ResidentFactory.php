<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'resident_number' => fake()->unique()->numerify('RES-#####'),

            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional()->firstName(),
            'last_name' => fake()->lastName(),
            'suffix' => fake()->optional()->randomElement([
                'Jr.',
                'Sr.',
                'III',
            ]),

            'sex' => fake()->randomElement([
                'Male',
                'Female',
            ]),

            'birth_date' => fake()->dateTimeBetween('-80 years', '-1 year'),

            'civil_status' => fake()->randomElement([
                'Single',
                'Married',
                'Widowed',
                'Separated',
            ]),

            'contact_number' => fake()->optional()->numerify('09#########'),

            'email' => fake()->unique()->safeEmail(),

            'occupation' => fake()->optional()->jobTitle(),

            'is_voter' => fake()->boolean(70),

            'is_household_head' => false,

            'household_id' => Household::inRandomOrder()->first()->id,
        ];
    }
}