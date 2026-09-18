<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\Resident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $households = [

            [
                'household_number' => 'HH-00001',
                'area' => 'St. Rose Village 3',
                'address' => 'Blk 4 Lot 12, St. Rose Village 3, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000001',

                'head' => [
                    'first_name' => 'Juan Miguel',
                    'middle_name' => 'Reyes',
                    'last_name' => 'Santos',
                    'suffix' => null,
                    'sex' => 'Male',
                    'birth_date' => '1982-04-15',
                    'civil_status' => 'Married',
                    'occupation' => 'Business Owner',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Marissa',
                        'middle_name' => 'Cruz',
                        'last_name' => 'Santos',
                        'sex' => 'Female',
                        'birth_date' => '1985-07-21',
                        'civil_status' => 'Married',
                        'occupation' => 'Teacher',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Andre Miguel',
                        'middle_name' => 'Cruz',
                        'last_name' => 'Santos',
                        'sex' => 'Male',
                        'birth_date' => '2006-09-04',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Sofia Mae',
                        'middle_name' => 'Cruz',
                        'last_name' => 'Santos',
                        'sex' => 'Female',
                        'birth_date' => '2011-02-12',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00002',
                'area' => 'Jubilation Amanzaya East',
                'address' => 'Blk 2 Lot 8, Jubilation Amanzaya East, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000002',

                'head' => [
                    'first_name' => 'Maria Teresa',
                    'middle_name' => 'Navarro',
                    'last_name' => 'Reyes',
                    'suffix' => null,
                    'sex' => 'Female',
                    'birth_date' => '1979-11-03',
                    'civil_status' => 'Married',
                    'occupation' => 'Office Staff',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Roberto',
                        'middle_name' => 'Garcia',
                        'last_name' => 'Reyes',
                        'sex' => 'Male',
                        'birth_date' => '1978-06-17',
                        'civil_status' => 'Married',
                        'occupation' => 'Technician',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Bianca',
                        'middle_name' => 'Navarro',
                        'last_name' => 'Reyes',
                        'sex' => 'Female',
                        'birth_date' => '2004-01-24',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Miguel',
                        'middle_name' => 'Navarro',
                        'last_name' => 'Reyes',
                        'sex' => 'Male',
                        'birth_date' => '2010-10-09',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00003',
                'area' => 'Jubilation Central',
                'address' => 'Blk 6 Lot 3, Jubilation Central, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000003',

                'head' => [
                    'first_name' => 'Carlo',
                    'middle_name' => 'Aquino',
                    'last_name' => 'Mendoza',
                    'suffix' => null,
                    'sex' => 'Male',
                    'birth_date' => '1988-03-28',
                    'civil_status' => 'Married',
                    'occupation' => 'Engineer',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Andrea',
                        'middle_name' => 'Flores',
                        'last_name' => 'Mendoza',
                        'sex' => 'Female',
                        'birth_date' => '1990-12-11',
                        'civil_status' => 'Married',
                        'occupation' => 'Accountant',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Gabriel',
                        'middle_name' => 'Flores',
                        'last_name' => 'Mendoza',
                        'sex' => 'Male',
                        'birth_date' => '2012-05-18',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                    [
                        'first_name' => 'Isabella',
                        'middle_name' => 'Flores',
                        'last_name' => 'Mendoza',
                        'sex' => 'Female',
                        'birth_date' => '2015-08-06',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00004',
                'area' => 'Villagio de Xavier',
                'address' => 'Blk 5 Lot 17, Villagio de Xavier, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000004',

                'head' => [
                    'first_name' => 'Angela',
                    'middle_name' => 'Ramos',
                    'last_name' => 'Bautista',
                    'suffix' => null,
                    'sex' => 'Female',
                    'birth_date' => '1984-09-19',
                    'civil_status' => 'Married',
                    'occupation' => 'Sales Supervisor',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Daniel',
                        'middle_name' => 'Torres',
                        'last_name' => 'Bautista',
                        'sex' => 'Male',
                        'birth_date' => '1981-02-25',
                        'civil_status' => 'Married',
                        'occupation' => 'Driver',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Nicole',
                        'middle_name' => 'Ramos',
                        'last_name' => 'Bautista',
                        'sex' => 'Female',
                        'birth_date' => '2007-04-07',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Nathaniel',
                        'middle_name' => 'Ramos',
                        'last_name' => 'Bautista',
                        'sex' => 'Male',
                        'birth_date' => '2013-07-14',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00005',
                'area' => 'St. Francis Subdivision VII',
                'address' => 'Blk 3 Lot 9, St. Francis Subdivision VII, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000005',

                'head' => [
                    'first_name' => 'Joshua',
                    'middle_name' => 'Garcia',
                    'last_name' => 'Dela Cruz',
                    'suffix' => null,
                    'sex' => 'Male',
                    'birth_date' => '1976-01-31',
                    'civil_status' => 'Married',
                    'occupation' => 'Self-employed',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Camille',
                        'middle_name' => 'Santos',
                        'last_name' => 'Dela Cruz',
                        'sex' => 'Female',
                        'birth_date' => '1979-04-22',
                        'civil_status' => 'Married',
                        'occupation' => 'Homemaker',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Adrian',
                        'middle_name' => 'Santos',
                        'last_name' => 'Dela Cruz',
                        'sex' => 'Male',
                        'birth_date' => '2003-06-10',
                        'civil_status' => 'Single',
                        'occupation' => 'Office Staff',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Jasmine',
                        'middle_name' => 'Santos',
                        'last_name' => 'Dela Cruz',
                        'sex' => 'Female',
                        'birth_date' => '2009-12-18',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00006',
                'area' => 'St. Anthony Village',
                'address' => 'Blk 8 Lot 6, St. Anthony Village, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000006',

                'head' => [
                    'first_name' => 'Paolo',
                    'middle_name' => 'Castillo',
                    'last_name' => 'Villanueva',
                    'suffix' => null,
                    'sex' => 'Male',
                    'birth_date' => '1986-08-05',
                    'civil_status' => 'Married',
                    'occupation' => 'Technician',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Patricia',
                        'middle_name' => 'Rivera',
                        'last_name' => 'Villanueva',
                        'sex' => 'Female',
                        'birth_date' => '1988-05-16',
                        'civil_status' => 'Married',
                        'occupation' => 'Teacher',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Luis',
                        'middle_name' => 'Rivera',
                        'last_name' => 'Villanueva',
                        'sex' => 'Male',
                        'birth_date' => '2008-03-03',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Beatriz',
                        'middle_name' => 'Rivera',
                        'last_name' => 'Villanueva',
                        'sex' => 'Female',
                        'birth_date' => '2014-09-27',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00007',
                'area' => 'Villa San Antonio',
                'address' => 'Blk 2 Lot 14, Villa San Antonio, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000007',

                'head' => [
                    'first_name' => 'Kristine',
                    'middle_name' => 'Flores',
                    'last_name' => 'Ramos',
                    'suffix' => null,
                    'sex' => 'Female',
                    'birth_date' => '1980-10-12',
                    'civil_status' => 'Widowed',
                    'occupation' => 'Store Owner',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Mark Anthony',
                        'middle_name' => 'Flores',
                        'last_name' => 'Ramos',
                        'sex' => 'Male',
                        'birth_date' => '2001-02-08',
                        'civil_status' => 'Single',
                        'occupation' => 'IT Support',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Alyssa',
                        'middle_name' => 'Flores',
                        'last_name' => 'Ramos',
                        'sex' => 'Female',
                        'birth_date' => '2005-05-30',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Christian',
                        'middle_name' => 'Flores',
                        'last_name' => 'Ramos',
                        'sex' => 'Male',
                        'birth_date' => '2012-11-20',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00008',
                'area' => 'Sta. Catalina',
                'address' => '28 Sta. Catalina, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000008',

                'head' => [
                    'first_name' => 'Rafael',
                    'middle_name' => 'Torres',
                    'last_name' => 'Navarro',
                    'suffix' => null,
                    'sex' => 'Male',
                    'birth_date' => '1973-06-26',
                    'civil_status' => 'Married',
                    'occupation' => 'Driver',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Lorna',
                        'middle_name' => 'Garcia',
                        'last_name' => 'Navarro',
                        'sex' => 'Female',
                        'birth_date' => '1975-08-13',
                        'civil_status' => 'Married',
                        'occupation' => 'Homemaker',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Paolo Miguel',
                        'middle_name' => 'Garcia',
                        'last_name' => 'Navarro',
                        'sex' => 'Male',
                        'birth_date' => '1999-01-06',
                        'civil_status' => 'Single',
                        'occupation' => 'Sales Associate',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Andrea Mae',
                        'middle_name' => 'Garcia',
                        'last_name' => 'Navarro',
                        'sex' => 'Female',
                        'birth_date' => '2008-07-22',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00009',
                'area' => 'U. Ambasa',
                'address' => '43 U. Ambasa, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000009',

                'head' => [
                    'first_name' => 'Danica',
                    'middle_name' => 'Reyes',
                    'last_name' => 'Cruz',
                    'suffix' => null,
                    'sex' => 'Female',
                    'birth_date' => '1987-12-02',
                    'civil_status' => 'Married',
                    'occupation' => 'Office Staff',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Jerome',
                        'middle_name' => 'Santos',
                        'last_name' => 'Cruz',
                        'sex' => 'Male',
                        'birth_date' => '1985-04-14',
                        'civil_status' => 'Married',
                        'occupation' => 'Electrician',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Samantha',
                        'middle_name' => 'Reyes',
                        'last_name' => 'Cruz',
                        'sex' => 'Female',
                        'birth_date' => '2007-09-12',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Joshua Gabriel',
                        'middle_name' => 'Reyes',
                        'last_name' => 'Cruz',
                        'sex' => 'Male',
                        'birth_date' => '2011-03-21',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],


            [
                'household_number' => 'HH-00010',
                'area' => 'Umboy',
                'address' => '61 Umboy, Brgy. San Antonio, Biñan, Laguna',
                'contact_number' => '09170000010',

                'head' => [
                    'first_name' => 'Mark Anthony',
                    'middle_name' => 'Bautista',
                    'last_name' => 'Garcia',
                    'suffix' => null,
                    'sex' => 'Male',
                    'birth_date' => '1983-05-09',
                    'civil_status' => 'Married',
                    'occupation' => 'Logistics Staff',
                    'is_voter' => true,
                ],

                'members' => [
                    [
                        'first_name' => 'Joanna',
                        'middle_name' => 'Mendoza',
                        'last_name' => 'Garcia',
                        'sex' => 'Female',
                        'birth_date' => '1986-01-28',
                        'civil_status' => 'Married',
                        'occupation' => 'Administrative Staff',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Daniel Miguel',
                        'middle_name' => 'Mendoza',
                        'last_name' => 'Garcia',
                        'sex' => 'Male',
                        'birth_date' => '2005-10-16',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => true,
                    ],
                    [
                        'first_name' => 'Sofia Angela',
                        'middle_name' => 'Mendoza',
                        'last_name' => 'Garcia',
                        'sex' => 'Female',
                        'birth_date' => '2012-06-08',
                        'civil_status' => 'Single',
                        'occupation' => 'Student',
                        'is_voter' => false,
                    ],
                ],
            ],

        ];


        $residentCounter = 1;


        foreach ($households as $householdData) {

            $head = $householdData['head'];

            $headFullName = trim(
                $head['first_name']
                . ' '
                . $head['middle_name']
                . ' '
                . $head['last_name']
                . (!empty($head['suffix'])
                    ? ' ' . $head['suffix']
                    : '')
            );


            /*
            |--------------------------------------------------------------------------
            | Create Household
            |--------------------------------------------------------------------------
            */

            $household = Household::create([
                'household_number' =>
                    $householdData['household_number'],

                'household_head' =>
                    $headFullName,

                'address' =>
                    $householdData['address'],

                'area' =>
                    $householdData['area'],

                'contact_number' =>
                    $householdData['contact_number'],
            ]);


            /*
            |--------------------------------------------------------------------------
            | Create Household Head
            |--------------------------------------------------------------------------
            */

            Resident::create([
                'resident_number' =>
                    'RES-' . str_pad(
                        $residentCounter++,
                        5,
                        '0',
                        STR_PAD_LEFT
                    ),

                'first_name' =>
                    $head['first_name'],

                'middle_name' =>
                    $head['middle_name'],

                'last_name' =>
                    $head['last_name'],

                'suffix' =>
                    $head['suffix'],

                'sex' =>
                    $head['sex'],

                'birth_date' =>
                    $head['birth_date'],

                'civil_status' =>
                    $head['civil_status'],

                'contact_number' =>
                    $householdData['contact_number'],

                'email' =>
                    null,

                'occupation' =>
                    $head['occupation'],

                'is_voter' =>
                    $head['is_voter'],

                'is_household_head' =>
                    true,

                'household_id' =>
                    $household->id,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Create Three Household Members
            |--------------------------------------------------------------------------
            */

            foreach ($householdData['members'] as $member) {

                Resident::create([
                    'resident_number' =>
                        'RES-' . str_pad(
                            $residentCounter++,
                            5,
                            '0',
                            STR_PAD_LEFT
                        ),

                    'first_name' =>
                        $member['first_name'],

                    'middle_name' =>
                        $member['middle_name'],

                    'last_name' =>
                        $member['last_name'],

                    'suffix' =>
                        null,

                    'sex' =>
                        $member['sex'],

                    'birth_date' =>
                        $member['birth_date'],

                    'civil_status' =>
                        $member['civil_status'],

                    'contact_number' =>
                        null,

                    'email' =>
                        null,

                    'occupation' =>
                        $member['occupation'],

                    'is_voter' =>
                        $member['is_voter'],

                    'is_household_head' =>
                        false,

                    'household_id' =>
                        $household->id,
                ]);
            }
        }
    }
}