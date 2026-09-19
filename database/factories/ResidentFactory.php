<?php

namespace Database\Factories;

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
            'Adrian',
            'Christian',
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


        $middleNames = [
            'Reyes',
            'Cruz',
            'Garcia',
            'Flores',
            'Navarro',
            'Ramos',
            'Aquino',
            'Castillo',
            'Torres',
            'Rivera',
        ];


        $areas = [
            'St. Rose Village 3',
            'Jubilation Amanzaya East',
            'Jubilation Central',
            'Villagio de Xavier',
            'St. Francis Subdivision VII',
            'St. Anthony Village',
            'Villa San Antonio',
            'Sta. Catalina',
            'U. Ambasa',
            'Umboy',
        ];


        $sex = fake()->randomElement([
            'Male',
            'Female',
        ]);


        $firstName =
            $sex === 'Male'
                ? fake()->randomElement($maleNames)
                : fake()->randomElement($femaleNames);


        $area =
            fake()->randomElement($areas);


        if (
            str_contains($area, 'Village')
            || str_contains($area, 'Subdivision')
            || str_contains($area, 'Jubilation')
            || str_contains($area, 'Villagio')
        ) {

            $address =
                'Blk '
                . fake()->numberBetween(1, 12)
                . ' Lot '
                . fake()->numberBetween(1, 30)
                . ', '
                . $area
                . ', Brgy. San Antonio, Biñan, Laguna';

        } else {

            $address =
                fake()->numberBetween(1, 100)
                . ' '
                . $area
                . ', Brgy. San Antonio, Biñan, Laguna';
        }


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
                fake()
                    ->dateTimeBetween(
                        '-70 years',
                        '-5 years'
                    )
                    ->format('Y-m-d'),

            'civil_status' =>
                fake()->randomElement([
                    'Single',
                    'Married',
                    'Widowed',
                    'Separated',
                ]),

            'contact_number' =>
                fake()->randomElement([
                    '0908',
                    '0915',
                    '0916',
                    '0917',
                    '0927',
                    '0928',
                    '0936',
                    '0995',
                    '0998',
                ])
                . ' '
                . fake()->numerify('###')
                . ' '
                . fake()->numerify('####'),

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

            'address' =>
                $address,

            'area' =>
                $area,

            'is_voter' =>
                fake()->boolean(70),
        ];
    }
}