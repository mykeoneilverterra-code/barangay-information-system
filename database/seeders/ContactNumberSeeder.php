<?php

namespace Database\Seeders;

use App\Models\Household;
use Illuminate\Database\Seeder;

class ContactNumberSeeder extends Seeder
{
    public function run(): void
    {
        $numbers = [
            'HH-00001' => '0917 120 4863',
            'HH-00002' => '0928 458 1726',
            'HH-00003' => '0908 763 2451',
            'HH-00004' => '0916 294 7835',
            'HH-00005' => '0995 631 8427',
            'HH-00006' => '0936 842 5179',
            'HH-00007' => '0927 516 3840',
            'HH-00008' => '0915 907 4268',
            'HH-00009' => '0909 348 6125',
            'HH-00010' => '0998 275 1463',
        ];

        foreach ($numbers as $householdNumber => $contactNumber) {

            $household = Household::where(
                'household_number',
                $householdNumber
            )->first();

            if (!$household) {
                continue;
            }

            // Update household contact number
            $household->update([
                'contact_number' => $contactNumber,
            ]);

            // Same contact number for the household head
            $household->residents()
                ->where('is_household_head', true)
                ->update([
                    'contact_number' => $contactNumber,
                ]);
        }
    }
}