<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_requests', function (Blueprint $table) {

            $table->id();

            $table->string(
                'request_number',
                30
            )->unique();

            $table->foreignId('resident_id')
                ->nullable()
                ->constrained('residents')
                ->nullOnDelete();

            $table->string(
                'document_type',
                100
            );

            $table->text('purpose');

            $table->date('date_requested');

            $table->string(
                'status',
                30
            )->default('Pending');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'document_requests'
        );
    }
};