<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Step 1: Add address and area directly to residents
        |--------------------------------------------------------------------------
        */

        Schema::table('residents', function (Blueprint $table) {

            $table->string('address', 500)
                ->default('')
                ->after('occupation');

            $table->string('area')
                ->default('')
                ->after('address');
        });


        /*
        |--------------------------------------------------------------------------
        | Step 2: Copy existing household location data to residents
        |--------------------------------------------------------------------------
        |
        | This protects our current 40 resident records.
        |
        */

        DB::statement("
            UPDATE residents AS r
            INNER JOIN households AS h
                ON h.id = r.household_id
            SET
                r.address = h.address,
                r.area = h.area
        ");


        /*
        |--------------------------------------------------------------------------
        | Step 3: Remove household relationship fields
        |--------------------------------------------------------------------------
        */

        Schema::table('residents', function (Blueprint $table) {

            $table->dropConstrainedForeignId('household_id');

            $table->dropColumn('is_household_head');
        });


        /*
        |--------------------------------------------------------------------------
        | Step 4: Remove households table
        |--------------------------------------------------------------------------
        */

        Schema::dropIfExists('households');
    }


    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Intentional destructive migration
        |--------------------------------------------------------------------------
        |
        | Household grouping cannot be accurately reconstructed after conversion.
        | Use your Git checkpoint + seeded demo data if you need to restore it.
        |
        */

        throw new RuntimeException(
            'This migration cannot be safely reversed because the Household structure was intentionally removed.'
        );
    }
};