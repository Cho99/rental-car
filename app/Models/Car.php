<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Feature;
use App\Models\Image;
use App\Models\Report;
use App\Models\Rule;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $guarded = [''];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'car_rules', 'car_id', 'rule_id');
    }
}
