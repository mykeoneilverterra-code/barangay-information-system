<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_number',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'sex',
        'birth_date',
        'civil_status',
        'contact_number',
        'email',
        'occupation',
        'address',
        'area',
        'is_voter',
        'profile_photo_path',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_voter' => 'boolean',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim(
            collect([
                $this->first_name,
                $this->middle_name,
                $this->last_name,
                $this->suffix,
            ])
            ->filter()
            ->implode(' ')
        );
    }
}