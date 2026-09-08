<?php

namespace Database\Seeders;

use App\Models\Household;
use App\Models\Resident;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create households first
        Household::factory(10)->create();

        // Then create residents
        Resident::factory(40)->create();
    }
}