<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseholdFactory extends Factory
{
    public function definition(): array
    {
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

        $area = fake()->randomElement($areas);

        $isSubdivision = in_array($area, [
            'St. Rose Village 3',
            'Jubilation Amanzaya East',
            'Jubilation Central',
            'Villagio de Xavier',
            'St. Francis Subdivision VII',
            'St. Anthony Village',
            'Villa San Antonio',
        ]);

        if ($isSubdivision) {

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
                fake()->numberBetween(1, 90)
                . ' '
                . $area
                . ', Brgy. San Antonio, Biñan, Laguna';
        }

        return [
            'household_number' =>
                fake()->unique()->numerify('HH-#####'),

            'household_head' =>
                'Sample Household Head',

            'address' =>
                $address,

            'area' =>
                $area,

            'contact_number' =>
                fake()->numerify('09#########'),
        ];
    }
}