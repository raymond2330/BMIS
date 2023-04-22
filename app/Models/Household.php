<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Household extends Model
{
    use HasFactory, Loggable;
    
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
