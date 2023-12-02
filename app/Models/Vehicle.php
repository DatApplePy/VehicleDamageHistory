<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'brand',
        'model',
        'production_year',
        'image'
    ];

    public function damageEvents(){
        return $this->belongsToMany(DamageEvent::class);
    }
}
