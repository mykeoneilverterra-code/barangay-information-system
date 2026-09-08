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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('resident_number', 20)->unique();
            $table->string('first_name', 60);
            $table->string('middle_name', 60)->nullable();
            $table->string('last_name', 60);
            $table->string('suffix', 20)->nullable();

            // Personal Information
            $table->string('sex', 20);
            $table->date('birth_date');
            $table->string('civil_status', 30);

            // Contact Information
            $table->string('contact_number', 20)->nullable();
            $table->string('email')->nullable()->unique();

            // Other Information
            $table->string('occupation', 100)->nullable();
            $table->boolean('is_voter')->default(false);
            $table->boolean('is_household_head')->default(false);

            // Household Relationship
            $table->foreignId('household_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};