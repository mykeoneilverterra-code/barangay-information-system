<?php

namespace Database\Seeders;

use App\Models\Resident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Fictional Filipino Resident Names
        |--------------------------------------------------------------------------
        */

        $people = [

            ['Juan Miguel', 'Reyes', 'Santos', 'Male'],
            ['Marissa', 'Cruz', 'Santos', 'Female'],
            ['Andre Miguel', 'Cruz', 'Santos', 'Male'],
            ['Sofia Mae', 'Cruz', 'Santos', 'Female'],

            ['Maria Teresa', 'Navarro', 'Reyes', 'Female'],
            ['Roberto', 'Garcia', 'Reyes', 'Male'],
            ['Bianca', 'Navarro', 'Reyes', 'Female'],
            ['Miguel', 'Navarro', 'Reyes', 'Male'],

            ['Carlo', 'Aquino', 'Mendoza', 'Male'],
            ['Andrea', 'Flores', 'Mendoza', 'Female'],
            ['Gabriel', 'Flores', 'Mendoza', 'Male'],
            ['Isabella', 'Flores', 'Mendoza', 'Female'],

            ['Angela', 'Ramos', 'Bautista', 'Female'],
            ['Daniel', 'Torres', 'Bautista', 'Male'],
            ['Nicole', 'Ramos', 'Bautista', 'Female'],
            ['Nathaniel', 'Ramos', 'Bautista', 'Male'],

            ['Joshua', 'Garcia', 'Dela Cruz', 'Male'],
            ['Camille', 'Santos', 'Dela Cruz', 'Female'],
            ['Adrian', 'Santos', 'Dela Cruz', 'Male'],
            ['Jasmine', 'Santos', 'Dela Cruz', 'Female'],

            ['Paolo', 'Castillo', 'Villanueva', 'Male'],
            ['Patricia', 'Rivera', 'Villanueva', 'Female'],
            ['Luis', 'Rivera', 'Villanueva', 'Male'],
            ['Beatriz', 'Rivera', 'Villanueva', 'Female'],

            ['Kristine', 'Flores', 'Ramos', 'Female'],
            ['Mark Anthony', 'Flores', 'Ramos', 'Male'],
            ['Alyssa', 'Flores', 'Ramos', 'Female'],
            ['Christian', 'Flores', 'Ramos', 'Male'],

            ['Rafael', 'Torres', 'Navarro', 'Male'],
            ['Lorna', 'Garcia', 'Navarro', 'Female'],
            ['Paolo Miguel', 'Garcia', 'Navarro', 'Male'],
            ['Andrea Mae', 'Garcia', 'Navarro', 'Female'],

            ['Danica', 'Reyes', 'Cruz', 'Female'],
            ['Jerome', 'Santos', 'Cruz', 'Male'],
            ['Samantha', 'Reyes', 'Cruz', 'Female'],
            ['Joshua Gabriel', 'Reyes', 'Cruz', 'Male'],

            ['Mark Anthony', 'Bautista', 'Garcia', 'Male'],
            ['Joanna', 'Mendoza', 'Garcia', 'Female'],
            ['Daniel Miguel', 'Mendoza', 'Garcia', 'Male'],
            ['Sofia Angela', 'Mendoza', 'Garcia', 'Female'],
        ];


        /*
        |--------------------------------------------------------------------------
        | Barangay San Antonio Areas
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Occupations
        |--------------------------------------------------------------------------
        */

        $occupations = [

            'Teacher',

            'Office Staff',

            'Driver',

            'Business Owner',

            'Sales Associate',

            'Technician',

            'Engineer',

            'IT Support',

            'Administrative Staff',

            'Self-employed',
        ];


        /*
        |--------------------------------------------------------------------------
        | Phone Prefixes
        |--------------------------------------------------------------------------
        */

        $phonePrefixes = [

            '0917',

            '0928',

            '0908',

            '0916',

            '0995',

            '0936',

            '0927',

            '0915',

            '0909',

            '0998',
        ];


        /*
        |--------------------------------------------------------------------------
        | Generate / Update 40 Stable Demo Residents
        |--------------------------------------------------------------------------
        |
        | updateOrCreate() is used instead of truncate().
        |
        | This means:
        |
        | - Existing resident links are not deleted.
        | - Resident Portal accounts are preserved.
        | - Existing document requests are preserved.
        | - Running php artisan db:seed again is safer.
        |
        */

        foreach ($people as $index => $person) {

            $number =
                $index + 1;


            $residentNumber =
                'RES-'
                . str_pad(
                    $number,
                    5,
                    '0',
                    STR_PAD_LEFT
                );


            $area =
                $areas[
                    $index % count($areas)
                ];


            /*
            |--------------------------------------------------------------------------
            | Fictional Address
            |--------------------------------------------------------------------------
            */

            if (
                str_contains(
                    $area,
                    'Village'
                )
                || str_contains(
                    $area,
                    'Subdivision'
                )
                || str_contains(
                    $area,
                    'Jubilation'
                )
                || str_contains(
                    $area,
                    'Villagio'
                )
            ) {

                $block =
                    ($index % 8) + 1;


                $lot =
                    (($index * 3) % 24) + 2;


                $address =
                    'Blk '
                    . $block
                    . ' Lot '
                    . $lot
                    . ', '
                    . $area
                    . ', Brgy. San Antonio, Biñan, Laguna';

            } else {

                $houseNumber =
                    12 + ($index * 3);


                $address =
                    $houseNumber
                    . ' '
                    . $area
                    . ', Brgy. San Antonio, Biñan, Laguna';
            }


            /*
            |--------------------------------------------------------------------------
            | Age / Birth Date
            |--------------------------------------------------------------------------
            */

            $age =
                12 + (($index * 7) % 54);


            $birthYear =
                2026 - $age;


            $birthMonth =
                ($index % 12) + 1;


            $birthDay =
                (($index * 2) % 27) + 1;


            $birthDate =
                sprintf(
                    '%04d-%02d-%02d',
                    $birthYear,
                    $birthMonth,
                    $birthDay
                );


            /*
            |--------------------------------------------------------------------------
            | Civil Status
            |--------------------------------------------------------------------------
            */

            if ($age < 18) {

                $civilStatus =
                    'Single';

            } elseif ($index % 9 === 0) {

                $civilStatus =
                    'Widowed';

            } elseif ($index % 3 === 0) {

                $civilStatus =
                    'Married';

            } else {

                $civilStatus =
                    'Single';
            }


            /*
            |--------------------------------------------------------------------------
            | Occupation
            |--------------------------------------------------------------------------
            */

            if ($age < 18) {

                $occupation =
                    'Student';

            } else {

                $occupation =
                    $occupations[
                        $index
                        % count($occupations)
                    ];
            }


            /*
            |--------------------------------------------------------------------------
            | Contact Number
            |--------------------------------------------------------------------------
            */

            if ($age >= 15) {

                $prefix =
                    $phonePrefixes[
                        $index
                        % count($phonePrefixes)
                    ];


                $middle =
                    str_pad(
                        (120 + ($index * 37))
                        % 1000,
                        3,
                        '0',
                        STR_PAD_LEFT
                    );


                $last =
                    str_pad(
                        (4863 + ($index * 271))
                        % 10000,
                        4,
                        '0',
                        STR_PAD_LEFT
                    );


                $contact =
                    $prefix
                    . ' '
                    . $middle
                    . ' '
                    . $last;

            } else {

                $contact =
                    null;
            }


            /*
            |--------------------------------------------------------------------------
            | Voter Status
            |--------------------------------------------------------------------------
            */

            $isVoter =
                $age >= 18
                && $index % 5 !== 0;


            /*
            |--------------------------------------------------------------------------
            | Create / Update Resident
            |--------------------------------------------------------------------------
            */

            Resident::updateOrCreate(

                /*
                |--------------------------------------------------------------------------
                | Find Resident Using Resident Number
                |--------------------------------------------------------------------------
                */

                [
                    'resident_number' =>
                        $residentNumber,
                ],


                /*
                |--------------------------------------------------------------------------
                | Resident Data
                |--------------------------------------------------------------------------
                */

                [

                    'first_name' =>
                        $person[0],

                    'middle_name' =>
                        $person[1],

                    'last_name' =>
                        $person[2],

                    'suffix' =>
                        null,

                    'sex' =>
                        $person[3],

                    'birth_date' =>
                        $birthDate,

                    'civil_status' =>
                        $civilStatus,

                    'contact_number' =>
                        $contact,

                    /*
                    |--------------------------------------------------------------------------
                    | Keep Demo Residents 1–40 Without Login Email
                    |--------------------------------------------------------------------------
                    |
                    | Resident Portal test accounts are added separately
                    | in DemoResidentAccountSeeder.
                    |
                    */

                    'email' =>
                        null,

                    'occupation' =>
                        $occupation,

                    'address' =>
                        $address,

                    'area' =>
                        $area,

                    'is_voter' =>
                        $isVoter,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Demo Resident Portal Accounts
        |--------------------------------------------------------------------------
        |
        | This will add / update:
        |
        | RES-00041 — Myke Oneil Magsino Verterra
        | RES-00042 — Timothy Reyes
        | RES-00043 — Edwin Aristotelis
        |
        | Their login accounts will also be created and linked
        | to their Resident records.
        |
        */

        $this->call(
            DemoResidentAccountSeeder::class
        );
    }
}