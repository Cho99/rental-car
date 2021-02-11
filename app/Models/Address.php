<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function parent()
    {
        return $this->belongsTo(Address::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Address::class, 'parent_id', 'id');
    }
}
