<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('households', function (Blueprint $table) {
            $table->renameColumn('purok', 'area');
        });
    }

    public function down(): void
    {
        Schema::table('households', function (Blueprint $table) {
            $table->renameColumn('area', 'purok');
        });
    }
};