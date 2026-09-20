<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoResidentAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | Demo Resident Accounts
            |--------------------------------------------------------------------------
            |
            | These accounts are intended for project testing only.
            |
            */

            $demoResidents = [

                /*
                |--------------------------------------------------------------------------
                | Myke
                |--------------------------------------------------------------------------
                */

                [
                    'resident' => [
                        'resident_number' => 'RES-00041',
                        'first_name' => 'Myke Oneil',
                        'middle_name' => 'Magsino',
                        'last_name' => 'Verterra',
                        'suffix' => null,
                        'sex' => 'Male',
                        'birth_date' => '2000-12-08',
                        'civil_status' => 'Married',
                        'contact_number' => '09615807893',
                        'email' => 'mykeverterra@gmail.com',
                        'occupation' => 'Technician',
                        'address' => 'B5 L3 San Antonio Binan City 4024 LAGUNA',
                        'area' => 'St. Rose Village 3',
                        'is_voter' => true,
                    ],

                    'password' => 'Resident123!',
                ],


                /*
                |--------------------------------------------------------------------------
                | Timothy
                |--------------------------------------------------------------------------
                */

                [
                    'resident' => [
                        'resident_number' => 'RES-00042',
                        'first_name' => 'Timothy',
                        'middle_name' => null,
                        'last_name' => 'Reyes',
                        'suffix' => null,
                        'sex' => 'Male',
                        'birth_date' => '2000-09-20',
                        'civil_status' => 'Single',
                        'contact_number' => '09615807893',
                        'email' => 'timothyreyes@gmail.com',
                        'occupation' => 'Technician',
                        'address' => 'B4 L3 San Antonio Binan City 4024 LAGUNA',
                        'area' => 'Umboy',
                        'is_voter' => true,
                    ],

                    'password' => 'Timothy123!',
                ],


                /*
                |--------------------------------------------------------------------------
                | Edwin
                |--------------------------------------------------------------------------
                */

                [
                    'resident' => [
                        'resident_number' => 'RES-00043',
                        'first_name' => 'Edwin',
                        'middle_name' => null,
                        'last_name' => 'Aristotelis',
                        'suffix' => null,
                        'sex' => 'Male',
                        'birth_date' => '1995-09-22',
                        'civil_status' => 'Single',
                        'contact_number' => '09615807893',
                        'email' => 'edwinaristotelis@gmail.com',
                        'occupation' => 'Professor',
                        'address' => 'B4 L3 San Antonio Binan City 4024 LAGUNA',
                        'area' => 'Villa San Antonio',
                        'is_voter' => true,
                    ],

                    'password' => 'Edwin123!',
                ],

            ];


            /*
            |--------------------------------------------------------------------------
            | Create / Update Residents and Accounts
            |--------------------------------------------------------------------------
            */

            foreach ($demoResidents as $demo) {

                $residentData =
                    $demo['resident'];


                /*
                |--------------------------------------------------------------------------
                | Create or update resident
                |--------------------------------------------------------------------------
                */

                $resident =
                    Resident::updateOrCreate(

                        [
                            'resident_number' =>
                                $residentData['resident_number'],
                        ],

                        $residentData
                    );


                /*
                |--------------------------------------------------------------------------
                | Create or update resident login account
                |--------------------------------------------------------------------------
                */

                User::updateOrCreate(

                    [
                        'email' =>
                            $resident->email,
                    ],

                    [
                        'name' =>
                            $resident->full_name,

                        'password' =>
                            Hash::make(
                                $demo['password']
                            ),

                        'role' =>
                            'resident',

                        'resident_id' =>
                            $resident->id,
                    ]
                );
            }
        });
    }
}