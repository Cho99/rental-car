<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [''];
    
    public function car()
    {
        return $this->belongsTo(Image::class);
    }
}
