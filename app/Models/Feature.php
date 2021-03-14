<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        "name",
        "image",
    ];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_feature', 'feature_id', 'user_id');
    }
}
