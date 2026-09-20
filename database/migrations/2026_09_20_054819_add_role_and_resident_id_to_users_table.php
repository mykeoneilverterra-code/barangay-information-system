<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('role', 20)
                ->default('resident')
                ->after('password');

            $table->foreignId('resident_id')
                ->nullable()
                ->unique()
                ->after('role')
                ->constrained('residents')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropConstrainedForeignId('resident_id');

            $table->dropColumn('role');
        });
    }
};