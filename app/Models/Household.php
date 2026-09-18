<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $fillable = [
        'household_number',
        'household_head',
        'address',
        'area',
        'contact_number',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}