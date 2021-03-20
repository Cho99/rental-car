<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_rules', 'rule_id', 'car_id');
    }
}
