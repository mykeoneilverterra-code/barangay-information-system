<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Resident Profile Photo
            |--------------------------------------------------------------------------
            |
            | Relative file path only ang ise-save dito.
            |
            | Example:
            | residents/AbCdEf123.jpg
            |
            */

            $table
                ->string('profile_photo_path')
                ->nullable()
                ->after('area');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {

            $table->dropColumn(
                'profile_photo_path'
            );

        });
    }
};