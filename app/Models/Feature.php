<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;

class Feature extends Model
{
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_feature', 'feature_id', 'user_id');
    }
}
