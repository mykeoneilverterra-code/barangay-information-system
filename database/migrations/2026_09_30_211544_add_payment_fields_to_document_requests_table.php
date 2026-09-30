<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {

            $table->boolean('payment_required')
                ->default(false)
                ->after('status');

            $table->decimal('amount', 10, 2)
                ->default(0)
                ->after('payment_required');

            $table->string('payment_method', 30)
                ->nullable()
                ->after('amount');

            $table->string('payment_status', 30)
                ->default('Not Required')
                ->after('payment_method');

            $table->string('payment_reference', 100)
                ->nullable()
                ->after('payment_status');

            $table->string('payment_proof_path')
                ->nullable()
                ->after('payment_reference');

            $table->text('payment_admin_remarks')
                ->nullable()
                ->after('payment_proof_path');

            $table->timestamp('payment_submitted_at')
                ->nullable()
                ->after('payment_admin_remarks');

            $table->timestamp('payment_verified_at')
                ->nullable()
                ->after('payment_submitted_at');

        });
    }

    public function down(): void
    {
        Schema::table('document_requests', function (Blueprint $table) {

            $table->dropColumn([
                'payment_required',
                'amount',
                'payment_method',
                'payment_status',
                'payment_reference',
                'payment_proof_path',
                'payment_admin_remarks',
                'payment_submitted_at',
                'payment_verified_at',
            ]);

        });
    }
};