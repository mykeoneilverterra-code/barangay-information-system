<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Demo Administrator Account
        |--------------------------------------------------------------------------
        |
        | This account is intended for development / classroom demonstration.
        |
        */

        $admin =
            User::firstOrNew([
                'email' =>
                    'admin@barangaysanantonio.test',
            ]);


        $admin->forceFill([

            'name' =>
                'Barangay Admin',

            'email' =>
                'admin@barangaysanantonio.test',

            'password' =>
                Hash::make(
                    'Admin123!'
                ),

            'role' =>
                'admin',

            'resident_id' =>
                null,

        ]);


        $admin->save();
    }
}