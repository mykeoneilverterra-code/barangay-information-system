<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [

        'resident_id',

        'request_number',

        'document_type',

        'purpose',

        'date_requested',

        'status',

        'admin_remarks',

        'processed_at',

        'payment_required',

        'amount',

        'payment_method',

        'payment_status',

        'payment_reference',

        'payment_proof_path',

        'payment_admin_remarks',

        'payment_submitted_at',

        'payment_verified_at',

    ];


    protected function casts(): array
    {
        return [

            'date_requested' => 'date',

            'processed_at' => 'datetime',

            'payment_required' => 'boolean',

            'amount' => 'decimal:2',

            'payment_submitted_at' => 'datetime',

            'payment_verified_at' => 'datetime',

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function resident(): BelongsTo
    {
        return $this->belongsTo(
            Resident::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Automatically Apply Document Fee
    |--------------------------------------------------------------------------
    |
    | This runs whenever a NEW document request is created.
    |
    */

    protected static function booted(): void
    {
        static::creating(
            function (DocumentRequest $documentRequest) {

                $fees =
                    config(
                        'barangay.document_fees',
                        []
                    );


                $fee = (float) (
                    $fees[
                        $documentRequest->document_type
                    ]
                    ?? 0
                );


                $documentRequest->amount =
                    $fee;


                $documentRequest->payment_required =
                    $fee > 0;


                if ($fee > 0) {

                    $documentRequest->payment_method =
                        null;

                    $documentRequest->payment_status =
                        'Unpaid';

                } else {

                    $documentRequest->payment_method =
                        'None';

                    $documentRequest->payment_status =
                        'Not Required';

                }

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Payment Helper
    |--------------------------------------------------------------------------
    */

    public function paymentSatisfied(): bool
    {
        if (!$this->payment_required) {
            return true;
        }

        return $this->payment_status === 'Paid';
    }


    /*
    |--------------------------------------------------------------------------
    | Printing Helper
    |--------------------------------------------------------------------------
    */

    public function canGenerateDocument(): bool
    {
        $allowedStatus =
            in_array(
                $this->status,
                [
                    'Ready for Release',
                    'Released',
                ],
                true
            );


        return
            $allowedStatus
            && $this->paymentSatisfied();
    }
}