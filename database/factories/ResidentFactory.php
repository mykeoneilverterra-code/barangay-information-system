<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    public function definition(): array
    {
        $maleNames = [
            'Juan Miguel',
            'Carlo',
            'Paolo',
            'Joshua',
            'Daniel',
            'Miguel',
            'Gabriel',
            'Rafael',
            'Nathaniel',
            'Adrian',
            'Christian',
            'Mark Anthony',
            'Luis',
            'Andre',
        ];

        $femaleNames = [
            'Maria Teresa',
            'Angela',
            'Camille',
            'Andrea',
            'Patricia',
            'Sofia',
            'Bianca',
            'Nicole',
            'Kristine',
            'Danica',
            'Isabella',
            'Jasmine',
            'Alyssa',
            'Beatriz',
        ];

        $middleNames = [
            'Cruz',
            'Reyes',
            'Garcia',
            'Flores',
            'Navarro',
            'Ramos',
            'Aquino',
            'Castillo',
            'Torres',
            'Rivera',
        ];

        $lastNames = [
            'Santos',
            'Reyes',
            'Mendoza',
            'Bautista',
            'Dela Cruz',
            'Villanueva',
            'Ramos',
            'Navarro',
            'Cruz',
            'Garcia',
        ];

        $sex = fake()->randomElement([
            'Male',
            'Female',
        ]);

        $firstName =
            $sex === 'Male'
                ? fake()->randomElement($maleNames)
                : fake()->randomElement($femaleNames);

        return [
            'resident_number' =>
                fake()->unique()->numerify('RES-#####'),

            'first_name' =>
                $firstName,

            'middle_name' =>
                fake()->randomElement($middleNames),

            'last_name' =>
                fake()->randomElement($lastNames),

            'suffix' =>
                null,

            'sex' =>
                $sex,

            'birth_date' =>
                fake()->dateTimeBetween('-70 years', '-5 years')
                    ->format('Y-m-d'),

            'civil_status' =>
                fake()->randomElement([
                    'Single',
                    'Married',
                    'Widowed',
                ]),

            'contact_number' =>
                fake()->optional(0.7)
                    ->numerify('09#########'),

            'email' =>
                null,

            'occupation' =>
                fake()->randomElement([
                    'Teacher',
                    'Office Staff',
                    'Driver',
                    'Business Owner',
                    'Sales Associate',
                    'Technician',
                    'Engineer',
                    'Student',
                    'Homemaker',
                    'Self-employed',
                ]),

            'is_voter' =>
                fake()->boolean(70),

            'is_household_head' =>
                false,

            'household_id' =>
                Household::factory(),
        ];
    }
}