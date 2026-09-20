<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentRequest extends Model
{
    use HasFactory;


    protected $fillable = [
        'request_number',
        'resident_id',
        'document_type',
        'purpose',
        'date_requested',
        'status',
    ];


    protected $casts = [
        'date_requested' => 'date',
    ];


    public function resident(): BelongsTo
    {
        return $this->belongsTo(
            Resident::class
        );
    }
}