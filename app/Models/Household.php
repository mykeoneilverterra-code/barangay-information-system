<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_number',
        'household_head',
        'address',
        'purok',
        'contact_number',
    ];

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }
}